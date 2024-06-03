## Shiny waffle

- interpreter for fun

## Grammer

#### Expressions

```
expression     → equality ;
equality       → comparison ( ( "!=" | "==" ) comparison )* ;
comparison     → term ( ( ">" | ">=" | "<" | "<=" ) term )* ;
term           → factor ( ( "-" | "+" ) factor )* ;
factor         → unary ( ( "/" | "*" ) unary )* ;
unary          → ( "!" | "-" ) unary
               | primary ;
primary        → NUMBER | STRING | "true" | "false" | "nil"
               | "(" expression ")" ;
```

#### Precendence

```
Name          Operators     Associates
Equality      == !=         Left
Comparison    > >= < <=     Left
Term          - +           Left
Factor        / *           Left
Unary         ! -           Right
```
