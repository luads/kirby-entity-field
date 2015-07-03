# Kirby Entity Field

This is an extension of the basic `select` field that adds a `filter` option to filter the selected entities by any column.

## Installation
If not already existing, add a new `fields` folder to your `site` directory. Place the `entity` directory inside the `fields` directory.

## Usage

```
fields:
  next:
    label: Next article
    type: entity
    query:
      page: posts
      fetch: children
      filters: 
        category: tech
