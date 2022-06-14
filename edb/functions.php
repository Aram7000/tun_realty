<?php

class EDB
{
    private $KEY;
    public $path;
    public $password;
    public $database;
    public $content;
    public $info;
    function __construct($path, $password = "none", $name = "NewEdbDatabase", $key = "none")
    {
        $this->KEY = $key;
        $this->name = $name;
        $this->path = $path;
        $this->password = $password;
        $this->database = $this->readDB($path, $password);
        if ($this->database != false) {
            $this->content = $this->database["content"];
            $this->info = $this->database["info"];
        }
    }
    public function changeKey($lastKey, $newKey)
    {
        $this->KEY = $lastKey;
        $_DB_ = $this->readDB($this->path, $this->password);
        if ($_DB_ != false) {
            $this->KEY = $newKey;
            $DB_Content = "";
            $DB_Content .= '|name : "' . $_DB_["info"][0][1] . '"' . "\n";
            $DB_Content .= '|password : "' . $_DB_["info"][1][1] . '"' . "\n";
            file_put_contents($this->path, $this->deCode($DB_Content));
            $this->addinDB($_DB_["content"][0]);
            return true;
        } else {
            return false;
        }
    }
    public function upDate()
    {
        $this->database = $this->readDB($this->path, $this->password);
        if ($this->database != false) {
            $this->content = $this->database["content"];
            $this->info = $this->database["info"];
        }
    }

    private function deCode($text)
    {
        $key = str_split($this->KEY);
        $text = str_split($text);
        $outText = "";
        $i = 0;
        $j = 0;

        while ($i < count($text)) {
            if ($j < count($key)) {
                $outText .= $text[$i] ^ $key[$j];
                $i++;
                $j++;
            } else {
                $j = 0;
            }
        }
        return $outText;
    }

    private function createDB($path, $name, $password = "none")
    {
        $DB_Content = "";
        $DB_Content .= '|name : "' . $name . '"' . "\n";
        $DB_Content .= '|password : "' . $password . '"' . "\n";
        fopen($path, "a+");
        file_put_contents($path, $this->deCode($DB_Content));
    }

    public function readDB($path, $password = "none")
    {
        if (!file_exists($path)) {
            $this->createDB($this->path, $this->name, $this->password);
        }
        $file = fopen($path, "r");
        $file = $this->deCode(file_get_contents($path));
        $db = [
            "info" => [],
            "content" => [],
        ];
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
                                $db["info"][count($db["info"]) - 1][0] .= $element;
                            }
                        }
                    }
                } else if ($in == "info:1") {
                    if ($element == '"') {
                        $inSTR = !$inSTR;
                    } else {
                        if ($inSTR) {
                            $db["info"][count($db["info"]) - 1][1] .= $element;
                        }
                    }
                } else if ($in == "content") {
                    if ($element == "\n" || $element == ";" || $element == "\r") {
                        $in = "content:1";
                    } else if ($element != "\n" || $element != ";" || $element != "\r") {
                        $db["content"][count($db["content"]) - 1][0] .= $element;
                    }
                } else if ($in == "content:1") {
                    if (!$inSTR && $element == ":") {
                        $in = "content:1:1";
                    } else if ($element == '"') {
                        $inSTR = !$inSTR;
                    } else {
                        if ($inSTR) {
                            $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][0] .= $element;
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
                                $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1] .= $element;
                                if (is_numeric($element) || $element == "." || $element = "e" && !$inSTR) {
                                    $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1] = $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1][count($db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1]) - 1];
                                }
                            }
                        } else if ($element != " " || $inSTR) {
                            $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1] .= $element;
                            if (is_numeric($element) || $element == "." || $element = "e" && !$inSTR) {
                                $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1] = $db["content"][count($db["content"]) - 1][count($db["content"][count($db["content"]) - 1]) - 1][1];
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
        $x = $this->findAsObj($db["info"], "password");
        if ($x && $password == $x) {
            return $db;
        }
        return false;
    }

    public function formatAsObj()
    {
        $db = $this->database;
        $newDB = [
            "info" => [],
            "content" => []
        ];
        for ($i = 0; $i < count($db["info"]); $i++) {
            $newDB["info"][$db["info"][$i][0]] = $db["info"][$i][1];
        }
        for ($i = 0; $i < count($db["content"]); $i++) {
            $newDB["content"][$db["content"][$i][0]] = [];
            for ($j = 1; $j < count($db["content"][$i]); $j++) {
                $newDB["content"][$db["content"][$i][0]][$db["content"][$i][$j][0]] = $db["content"][$i][$j][1];
            }
        }
        return $newDB;
    }

    public function addinDB($table, $delete = false)
    {
        $path = $this->path;
        $password = $this->password;
        $table[0] = str_replace('"', "''", $table[0]);
        for ($i = 1; $i < count($table); $i++) {
            $element = $table[$i][1];
            if (is_array($element)) {
                for ($j = 0; $j < count($element); $j++) {
                    $string = $element[$j];
                    if (is_string($string)) {
                        $string = str_replace('"', "''", $string);
                    }
                    $table[$i][1][$j] = $string;
                }
            } else if (is_string($element)) {
                $string = $element;
                if (is_string($string)) {
                    $string = str_replace('"', "''", $string);
                }
                $table[$i][1] = $string;
            }
        }
        if ($this->readDB($path, $password)) {
            $db = $this->readDB($path, $password);
            $DB_Content = "";
            $rewrite = false;
            for ($i = 0; $i < count($db["info"]); $i++) {
                $DB_Content .= '|' . $db["info"][$i][0] . ' : "' . $db["info"][$i][1] . '"' . "\n";
            }
            $db = $db["content"];
            for ($i = 0; $i < count($db); $i++) {
                if ($db[$i][0] == $table[0]) {
                    $db[$i] = $table;
                    $rewrite = true;
                }
                $DB_Content .= "\n|||" . $db[$i][0] . "\n";
                for ($j = 1; $j < count($db[$i]); $j++) {
                    $value = $db[$i][$j][1];
                    if (is_numeric($value) && !is_string($value)) {
                        $DB_Content .= '    "' . $db[$i][$j][0] . '" : ' . $db[$i][$j][1] . '' . "\n";
                    } else if (is_array($value)) {
                        $content = '    "' . $db[$i][$j][0] . '" : [';
                        for ($k = 0; $k < count($db[$i][$j][1]); $k++) {
                            $element = $db[$i][$j][1][$k];
                            if (is_numeric($element)) {
                                $content .= $element;
                            } else {
                                $content .= '"' . $element . '"';
                            }
                            if (isset($db[$i][$j][1][$k + 1])) {
                                $content .= ", ";
                            }
                        }
                        $content .= "]";
                        $DB_Content .= $content . "\n";
                    } else {
                        $DB_Content .= '    "' . $db[$i][$j][0] . '" : "' . $db[$i][$j][1] . '"' . "\n";
                    }
                }
            }
            if (!$rewrite) {
                $DB_Content .= "\n|||" . $table[0] . "\n";
                for ($i = 1; $i < count($table); $i++) {
                    if (is_array($table[$i][1])) {
                        $content = '    "' . $table[$i][0] . '" : [';
                        for ($k = 0; $k < count($table[$i][1]); $k++) {
                            $element = $table[$i][1][$k];
                            if (is_numeric($element)) {
                                $content .= $element;
                            } else {
                                $content .= '"' . $element . '"';
                            }
                            if (isset($table[$i][1][$k + 1])) {
                                $content .= ", ";
                            }
                        }
                        $content .= "]";
                        $DB_Content .= $content . "\n";
                    } else if (isset($value) && is_numeric($value)) {
                        var_dump($table[$i]);
                        $DB_Content .= '    "' . $table[$i][0] . '" : ' . $table[$i][1] . '' . "\n";
                    } else {
                        $DB_Content .= '    "' . $table[$i][0] . '" : "' . $table[$i][1] . '"' . "\n";
                    }
                }
            }
            file_put_contents($path, $this->deCode($DB_Content));
            return true;
        } else {
            return false;
        }
    }
    public function findAsObj($array, $key)
    {
        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i][0] == $key) {
                return $array[$i][1];
            }
        }
        return 0;
    }
    public function removeTable($tableName) {
        $_DB_ = $this->content;
        $this->reset();
        for ($i=0; $i < count($_DB_); $i++) {
            $element = $_DB_[$i];
            if ($element[0] != $tableName) {
                $this->addinDB($element);
            }
        }
    }
    public function reset() {
        $_DB__ = $this->readDB($this->path, $this->password);
        $DB_info = $_DB__["info"];
        $DB_Content = "";
        $DB_Content .= '|name : "' . $DB_info[0][1] . '"' . "\n";
        $DB_Content .= '|password : "' . $DB_info[1][1] . '"' . "\n";
        fopen($this->path, "a+");
        file_put_contents($this->path, $this->deCode($DB_Content));
    }

    public function getJs($db_name = "db") {
        $_DB__ = $this->readDB($this->path, $this->password);
        $db = $_DB__["content"];
        
        $text = 
        "
        <script>
            let " . $db_name . " = [
        ";
        for ($i=0; $i < count($db); $i++) {
            $table = $db[$i];
            $text .= "[
                `" . $table[0] . "`,
            ";
            for ($j = 1; $j < count($table); $j++) {
                $row = $table[$j];
                if (is_array($row[1])) {
                    $text .= "[`" . $row[0] . "`, [";
                    for ($k = 0; $k < count($row[1]); $k++) {
                        $element = $row[1][$k];
                        $text .= "`" . $element . "`, ";
                    }
                    $text .= "]],
                    ";
                } else {
                    $text .= "[`" . $row[0] . "`, `" . $row[1] . "`],
                    ";
                }
            }
            $text .= "],
            ";
        }
        $text .= "
        ];
        ";

        $text .= "</script>";
        echo $text;
    }

    public function debugLog()
    {
?>
        <style>
            .EDB_DEBUG_CONT {
                background-color: #222222;
                padding: 10px;
                margin: 10px;
                border-radius: 10px;
            }

            .EDB_DEBUG_CONT span {
                color: #ffffff;
                padding-left: 5px;
                border-radius: 5px;
                font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
            }

            .EDB_IC {
                color: #6688ff !important;
            }

            .EDB_VN {
                margin-left: 30px;
                color: #66ffff !important;
            }

            .EDB_STR_VALUE {
                color: #ffaa66 !important;
            }

            .EDB_TABLE_NAME {
                margin-left: 30px;
                color: #9966ff !important;
            }

            .EDB_TABLE_VN {
                margin-left: 60px;
                color: #6688ff !important;
            }

            .EDB_TABLE_STR_VALUE {
                color: #ffaa66 !important;
            }

            .EDB_ARR_STR_VALUE {
                margin-left: 90px;
                color: #ffaa66 !important;
            }

            .EDB_ARR_INT_VALUE {
                margin-left: 90px;
                color: #66ff88 !important;
            }

            .EDB_ARR_END {
                margin-left: 60px;
            }
        </style>
        <?php
        $_DB_ = $this->readDB($this->path, $this->password);
        ?>
        <div class="EDB_DEBUG_CONT">
            <span class="EDB_IC">
                Information
            </span><span>{</span><br>
            <span class="EDB_VN">Name :</span>
            <span class="EDB_STR_VALUE">"<?php echo $_DB_["info"][0][1] ?>"</span><br>
            <span class="EDB_VN">Password :</span>
            <span class="EDB_STR_VALUE">"<?php echo $_DB_["info"][1][1] ?>"</span><br>
            <span>}</span><br><br>
            <span class="EDB_IC">
                Content
            </span><span>{</span><br>
            <?php for ($i = 0; $i < count($_DB_["content"]); $i++) {
                $Table = $_DB_["content"][$i]; ?>
                <span class="EDB_TABLE_NAME">|||<?php echo $Table[0] ?></span><br>
                <?php for ($j = 1; $j < count($Table); $j++) { ?>
                    <span class="EDB_TABLE_VN"><?php echo $j . " | " . $Table[$j][0] ?>"</span>
                    <span>:</span>
                    <?php if (gettype($Table[$j][1]) == "string") { ?>
                        <span class="EDB_TABLE_STR_VALUE">"<?php echo $Table[$j][1] ?>"</span>
                    <?php } else if (gettype($Table[$j][1]) == "array") { ?>
                        <span class="EDB_TABLE_ARR_VALUE">[<span><br>
                                <?php for ($k = 0; $k < count($Table[$j][1]); $k++) {
                                    $Element = $Table[$j][1][$k] ?>
                                    <?php if (gettype($Element) == "string") { ?>
                                        <span class="EDB_ARR_STR_VALUE">"<?php echo $Element ?>"</span>
                                    <?php }
                                    if (isset($Table[$j][1][$k + 1])) echo "<span>,</span><br>"; ?>
                                <?php } ?>
                                <br><span class="EDB_ARR_END">]</span>
                            <?php } ?>
                            <br>
                        <?php } ?>
                    <?php } ?><br>
                    <span>}</span><br>
        </div>

    <?php

    }
}

function formatRivets($string)
{
    return str_replace('"', "''", $string);
}


function includeJS($toRoot)
{ ?>

    <script>
        toRoot = "<?php echo $toRoot ?>";
    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="<?php echo $toRoot ?>edb/functions.js"></script>
<?php }





function inStr($x, $y)
{
    $is = false;
    if (is_array($x)) {
        for ($i = 0; $i < count($x); $i++) {
            if (str_replace($x[$i], "", $y) != $y) {
                $is = true;
                break;
            }
        }
    } else {
        if (str_replace($x, "", $y) != $y) {
            $is = true;
        }
    }
    return $is;
}

function deCode($text, $key) {
    $key = str_split($key);
    $text = str_split($text);
    $outText = "";
    $i = 0;
    $j = 0;

    while ($i < count($text)) {
        if ($j < count($key)) {
            $outText .= $text[$i] ^ $key[$j];
            $i++;
            $j++;
        } else {
            $j = 0;
        }
    }
    return $outText;
}


function console_log ($text) {
    ?>
    <script>
        console.log(`<?php echo $text ?>`);
    </script>
    <?php
}

