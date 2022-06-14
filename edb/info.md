# About

Database format: .EDB
Database Name: Eazy DataBase
Version: 1.0.0

# How To Use
## PHP
```EDB
|name = "database name"
|password = "database password"

|||Table1
    "variable1" : "value1"
    "numeric variable" : 100500
    "array" : ["something", 100500, "123456"]

    
|||Table2
    "variable2" : "value2"
    "something else" : 123456
    "array" : ["value2" , "100500", 123456]
```

```PHP
include "/path/from/page/to/edb/functions.php"
$db = new EDB("/path/from/page/to/edb/databases/database.edb", "database password");
```
Output
```PHP
[
    "path" => "/path/from/page/to/edb/databases/database.edb",
    "password" => "database password",
    "database" => [
        "info" => [
            ["name", "database name"],
            ["password", "database password"],
        ],
        "content" => [
            [
                "Table1",
                ["variable1", "value1"],
                ["numeric variable", 100500],
                ["array", ["something", 100500, "123456"]],
            ],
            [
                "Table2",
                ["variable2", "value2"],
                ["something else", 123456],
                ["array", ["value2" , "100500", 123456]],
            ],
        ]
    ],
];
```
```PHP
$db->formatAsObject();
```
Output
```PHP
[
    "info" => [
        "name" => "database name"
        "password" => "database password"
    ],
    "content" => [
        "Table1" => [
            "variable1" => "value1",
            "numeric variable" => 100500,
            "array" => ["something", 100500, "123456"],
        ],
        "Table1" => [
            "variable2" => "value2",
            "something else" => 123456,
            "array" => ["value2", "100500", 123456],
        ],
    ],
];
```
```PHP
$table = [
    "Table3",
    ["variable3", "value3"],
    ["some array", [123456, "00001111", "Hello World!"]],
]
$db->addinDB($table);
```
Output
```EDB
|name = "database name"
|password = "database password"

|||Table1
    "variable1" : "value1"
    "numeric variable" : 100500
    "array" : ["something", 100500, "123456"]

    
|||Table2
    "variable2" : "value2"
    "something else" : 123456
    "array" : ["value2" , "100500", 123456]

|||Table3
    "variable3" : "value3"
    "some array" : [123456, "00001111", "Hello World!"]
```


```PHP
<?php

$toRoot = "/path/to/your/root/directory/";

?>
<html>
    <head>
        <?php include "/path/to/edb/require.php" ?>
        <script src="script.js"></script>
    </head>

    <body>

    </body>

</html>

```

```javascript
/*
toRoot = your $toRoot variable in php
*/
db = new EDB("database", "database password")

console.log(db);

```

Output

```javascript
db = {
    content: [
        [
            "Table1",
            ["variable1", "value1"],
            ["numeric variable", 100500],
            ["array", ["something", 100500, "123456"]],
        ],
        [
            "Table2",
            ["variable2", "value2"],
            ["something else", 123456],
            ["array", ["value2" , "100500", 123456]],
        ],
    ],
    info: [
        ["name", "database name"],
        ["password", "database password"],
    ]
    database: {
        content: [
            [
                "Table1",
                ["variable1", "value1"],
                ["numeric variable", 100500],
                ["array", ["something", 100500, "123456"]],
            ],
            [
                "Table2",
                ["variable2", "value2"],
                ["something else", 123456],
                ["array", ["value2" , "100500", 123456]],
            ],
        ]
        info: [
            ["name", "database name"],
            ["password", "database password"],
        ]
    },
    password: "database password";
    path: toRoot + "/edb/databases/database.edb";
}


```
