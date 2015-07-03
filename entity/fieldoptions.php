<?php

class EntityFieldOptions extends FieldOptions 
{
    public function __construct($field) 
    {
        $this->field = $field;
        
        $defaults = array(
            'page' => $field->page->id(),
            'fetch' => 'children',
            'value' => '{{uid}}',
            'text' => '{{title}}',
            'flip' => false,
            'filters' => [],
        );

        $query = array_merge($defaults, $field->query);
        $page = page($query['page']);
        $items = $this->items($page, $query['fetch']);

        foreach ($query['filters'] as $field => $value) {
            if (!is_string($field)) {
                continue;
            }

            $items = $items->filterBy($field, $value);
        }

        if ($query['flip']) {
            $items = $items->flip();
        }

        foreach($items as $item) {
            $value = $this->tpl($query['value'], $item);
            $text  = $this->tpl($query['text'], $item);

            $this->options[$value] = $text;
        }

        // sorting
        if (!empty($this->field->sort)) {
          switch(strtolower($this->field->sort)) {
            case 'asc':
              asort($this->options);
              break;
            case 'desc':
              arsort($this->options);
              break;
          }
        }
    }
}
