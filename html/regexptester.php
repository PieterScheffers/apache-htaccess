<?php

function ee($str)
{
    return htmlentities($str, ENT_QUOTES, "UTF-8");
}

function e($str)
{
    echo ee($str);
}

function get($array, $key, $default)
{
    return isset($array[$key]) ? $array[$key] : $default;
}

$pattern = get($_POST, 'pattern', "^/blog/$");
$testQuantity = get($_POST, 'testQuantity', 1);
$tests = get($_POST, 'test', []);

$result = [];
$maxMatches = 0;

foreach($tests as $test ) {

    $return = @preg_match('#' . $pattern . '#', $test, $matches);

    if ($return === 1) {
        $maxMatches = max($maxMatches, count($matches));
        $result[] = array_merge( [ 'matched' ],  $matches );
    } else {
        $result[] = [ ($return === FALSE ? 'invalid' : 'non-matched') ];
    }
}

?>
<html>
<head>
    <title>Regexp checker</title>
</head>
<body>
    <p>&nbsp;</p>
    <form method="post" action="<?php echo $_SERVER['SCRIPT_NAME'];?>">
        <label for="pl">Regexp Pattern: </label>
        <input id="p" name="pattern" size="50" value="<?php e($pattern);?>" />
        <label for="n">&nbsp; &nbsp; Number of test vectors: </label>
        <input id="n" name="testQuantity"  size="3" value="<?php echo $testQuantity;?>"/>
        <input type="submit" name="go" value="OK"/><hr/><p>&nbsp;</p>
        <table>
            <thead>
                <tr>
                    <th>Test Vector</th>
                    <th>Result</th>
                    <?php 
                        for ($i=0; $i < $maxM; $i++ ) {
                            echo "<th>\${$i}</b></th>";
                        }
                    ?>
                </tr>
            </thead>
            <tbody>
                <?php for ($i=0; $i < $testQuantity; $i++) { ?>
                    <tr>
                        <td><input name="test[]" value="<?php e($tests[$i]); ?>"/></td>
                        <?php
                        
                        for ($j = 0; $j < $maxMatches; $j++) {
                            $value = isset($result[$i][$j]) ? ee($result[$i][$j]) : '&nbsp;';

                            echo '<td>' . $value . '</td>'; 
                        }

                        ?>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </form>
</body>
</html>
