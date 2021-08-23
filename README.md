# One Piece API

A chapter has information

## Structure
```
Chapter
    Links
    Entities of a Given types (cover, short summary, summary, characters)
    Cover
    ShortSummary
    Summary
    * Characters (Calculated field)

Entity
    N Aliases
```

## Goals:

Dado que onepiece es una serie tan larga con tantas personajes,
me motiva para saber mas, ver las vinculaciones de personajes

MPV
- [X] Buscar encuentros
- [ ] Buscar capitulo por numero
- [ ] Buscar Entidad por un alias
- [ ] Obtener todos los alias de una entidad (por id)
- [ ] Hacer un recurso corto del capitulo


## TODO:
- Entity type as it owns class, and move to string
- Chapter by number since now is by id
