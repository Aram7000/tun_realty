$_DB = "";

const ajaxReadDB = ($path) => {
    $password = "none";
    if (DATABASES_CLOSED()) {
        throw "No Access To Database";
    } else {
        $.ajax({
            type: 'POST',
            url: toRoot + 'edb/readDB.php',
            data: {
                path: $path,
                password: $password,
            },
            success: function (data) {
                let $file = data;
                $db = {
                    info: [],
                    content: [],
                }
                $file = str_split($file);
                $l_count = 0;
                $in = "root";
                $inSTR = false;
                $inArray = false;
                for ($i = 0; $i < count($file); $i++) {
                    $element = $file[$i];

                    if (!$inSTR && $element == "|") {
                        $l_count++;
                    } else {
                        if ($l_count == 1) {
                            array_push($db["info"], ["", ""]);
                            $in = "info";
                        } else if ($l_count == 3) {
                            array_push($db["content"], ["", ["", ""]]);
                            $in = "content";
                        }
                        $l_count = 0;
                        if ($in == "info") {
                            if ($element == ":") {
                                $in = "info:1";
                            } else {
                                if ($element == '"') {
                                    $inSTR = !$inSTR;
                                } else {
                                    if ($inSTR || $element != " ") {
                                        $db["info"][count($db["info"]) - 1][0] += $element;
                                    }
                                }
                            }
                        } else if ($in == "info:1") {
                            if ($element == '"') {
                                $inSTR = !$inSTR;
                            } else {
                                if ($inSTR) {
                                    $db["info"][count($db["info"]) - 1][1] += $element;
                                }
                            }
                        } else if ($in == "content") {
                            if ($element == "\n" || $element == ";" || $element == "\r") {
                                $in = "content:1";
                            } else if ($element != "\n" || $element != ";" || $element != "\r") {
                                $db["content"][count($db["content"]) - 1][0] += $element;
                            }
                        } else if ($in == "content:1") {
                            if (!$inSTR && $element == ":") {
                                $in = "content:1:1";
                            } else if ($element == '"') {
                                $inSTR = !$inSTR;
                            } else {
                                if ($inSTR) {
                                    $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][0] += $element;
                                }
                            }
                        } else if ($in == "content:1:1") {
                            if (!$inSTR && ($element == "\n" || $element == ";" || $element == "\r")) {
                                array_push($db["content"][count($db["content"]) - 1], ["", ""]);
                                $in = "content:1";
                            } else {
                                if ($element == '"') {
                                    $inSTR = !$inSTR;

                                } else if ($element == "[" || $element == "]") {

                                    if ($element == "[") {
                                        $inArray = true;
                                    } else {
                                        $inArray = false;
                                    }
                                    if ($inArray) {
                                        $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1] = [""];
                                    }
                                } else if ($inArray) {
                                    if ($element == "," && !$inSTR) {
                                        array_push($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1], "");
                                    } else if ($element != " " || $inSTR) {
                                        $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1] += $element;
                                        if (is_numeric($element) && !$inSTR) {
                                            $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1] = intval($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1]);
                                        }
                                    }
                                } else if ($element != " " || $inSTR) {
                                    $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1] += $element;
                                    if (is_numeric($element) && !$inSTR) {
                                        $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1] = intval($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]);
                                    }
                                }
                            }
                        }
                    }
                }
                for ($i = 0; $i < count($db["content"]); $i++) {
                    for ($j = 1; $j < count($db["content"][$i]); $j++) {
                        if ($db["content"][$i][$j] == ["", ""]) array_splice($db["content"][$i], $j);
                    }
                }
                window.$_DB = $db;

            }
        })
    }
}



let count = (array) => {
    return array.length;
}
let str_split = (string, keyword = "") => {
    return string.split(keyword);
}
let is_numeric = (value) => {
    return !isNaN(value);
}
let is_array = (value) => {
    return value.isArray;
}
let array_push = (array, value) => {
    array.push(value);
}
let intval = (int) => {
    return parseFloat(int);
}
class EDB {
    constructor($path) {
        this.db;
        this.path = `databases/${$path}.edb`;
        this.password = "none";
        this.database = (DATABASES_CLOSED()) ? false : this.readDB();
        this.onDatabaseChangeFunction;
        this.databaseChangeInterval;
        this.lastValue = this.database;
        this.lg = true;
        if (this.database != "") {
            this.content = this.database.content;
            this.info = this.database.info;
            this.onload();
        } else {
            let XX = setInterval(() => {
                this.database = this.readDB();
                if (this.database != "" && this.database.info.length > 0) {
                    this.content = this.database.content;
                    this.info = this.database.info;
                    this.onload();
                    clearInterval(XX);
                }
            }, 1);
        }
        this.ifValueChanged = () => {
            this.database = this.readDB();
            let interval = setInterval(() => {
                if (this.readDB().content.join("") != this.database.content.join("")) {
                    if (this.lg) {
                        this.database = this.readDB();
                        this.onDatabaseChangeFunction();
                    }
                    this.lg = !this.lg;
                }
            }, 1);
        }
    }

    readDB = () => {
        let $path = this.path;
        let $password = this.password;
        ajaxReadDB($path, $password);
        let x = window.$_DB;
        if (x.content != undefined) {
            for (let i in x.content) {
                const table = x.content[i];
                for (let j = 1; j < table.length; j++) {
                    const element = table[j];
                    if (element.join() == ["", ""].join()) {
                        x.content[i].splice(j, 1);
                    }
                }
            }
        }
        return x;
    }

    formatAsObj = () => {
        let $db = this.database;
        let $newDB = {
            info: [],
            content: [],
        }

        for (let $i = 0; $i < count($db["info"]); $i++) {
            $newDB["info"][$db["info"][$i][0]] = $db["info"][$i][1];
        }
        for (let $i = 0; $i < count($db["content"]); $i++) {
            $newDB["content"][$db["content"][$i][0]] = [];
            for (let $j = 1; $j < count($db["content"][$i]); $j++) {
                $newDB["content"][$db["content"][$i][0]][$db["content"][$i][$j][0]] = $db["content"][$i][$j][1];
            }
        }
        return $newDB;
    }

    addinDB = ($table) => {
        if (DATABASES_CLOSED()) {
            throw "No Access To Databases";
        } else {
            $.ajax({
                type: 'POST',
                url: toRoot + 'edb/addinDB.php',
                data: {
                    path: this.path,
                    password: this.password,
                    table: $table,
                },
                success: function (data) {

                }
            });
        }
    }

    onDatabaseChange = (dcf) => {
        this.onDatabaseChangeFunction = dcf;
        this.ifValueChanged();
    }
    onload = () => {

    }
}

const closeDatabases = () => {
    Object.defineProperty(window, "CLOSED", {
        value: true,
        configurable: false,
        writable: false,
    })
}

const DATABASES_CLOSED = () => {
    return (typeof (CLOSED) === "undefined") ? false : true;
}