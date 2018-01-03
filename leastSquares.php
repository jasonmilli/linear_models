<?php
    require('functions.php');

    $count = 0;
    $sumX = 0;
    $sumY = 0;
    $sumXY = 0;
    $sumXSquared = 0;
    $gradient = null;
    $displacement = null;
    if (isset($_REQUEST['results']) && chNum($_REQUEST, 'question')) {
        foreach ($_REQUEST['results'] as $result) {
            if (chNums($result, ['x', 'y'])) {
                $count++;
                $sumX += $result['x'];
                $sumY += $result['y'];
                $sumXY += $result['x'] * $result['y'];
                $sumXSquared += pow($result['x'], 2);
            }
        }

        $gradient = ($sumXY / $count - ($sumX / $count) * ($sumY / $count))
                    / ($sumXSquared / $count - pow($sumX / $count, 2));
        $displacement = $sumY / $count - $gradient * $sumX / $count;

        $answer = $_REQUEST['question'] * $gradient + $displacement;
        echo "<h1>The predicted result for {$_REQUEST['question']} is {$answer}</h1>";
    }
?>

<form action="leastSquares.php">
    <?php
        for ($i = 0; $i < 30; $i++) {
    ?>
    <input name="results[<?php echo $i; ?>][x]"
           value="<?php echo isset($_REQUEST['results'][$i]['x']) ? $_REQUEST['results'][$i]['x'] : '' ?>" />
    <input name="results[<?php echo $i; ?>][y]"
           value="<?php echo isset($_REQUEST['results'][$i]['y']) ? $_REQUEST['results'][$i]['y'] : '' ?>" />
    <br />
    <?php } ?>
    <br />
    <input name="question"
           value="<?php echo isset($_REQUEST['question']) ? $_REQUEST['question'] : '' ?>" />
    <input type="submit" />
</form>

<?php // Debug

p($_REQUEST, 'Request');
p($sumX, 'Sum of x');
p($sumY, 'Sum of y');
p($sumXY, 'Sum of xy');
p($sumXSquared, 'Sum of x squared');
p($gradient, 'Gradient');
p($displacement, 'Displacement');
