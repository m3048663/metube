<?php
 
class WordCloud
{
    var $words = array();
 
    function __construct($text)
    {
        $text = preg_replace('/\W/', ' ', $text);
 
        $words = split(' ', $text);        
        foreach ($words as $key => $value)
        {
                $this->addWord($value);
        }
 
    }
 
    function addWord($word, $value = 1)
    {
        $word = strtolower($word);
 
        if (array_key_exists($word, $this->words))
            $this->words[$word] += $value;
        else
            $this->words[$word] = $value;
    }
 
 
    function getSize($percent)
    {
        $size = "font-size: ";
 
        if ($percent >= 99)
            $size .= "4em;";
        else if ($percent >= 95)
            $size .= "3.8em;";
        else if ($percent >= 80)
            $size .= "3.5em;";
        else if ($percent >= 70)
            $size .= "3em;";
        else if ($percent >= 60)
            $size .= "2.8em;";
        else if ($percent >= 50)
            $size .= "2.5em;";
        else if ($percent >= 40)
            $size .= "2.3em;";
        else if ($percent >= 30)
            $size .= "2.1em;";
        else if ($percent >= 25)
            $size .= "2.0em;";
        else if ($percent >= 20)
            $size .= "1.8em;";
        else if ($percent >= 15)
            $size .= "1.6em;";
        else if ($percent >= 10)
            $size .= "1.3em;";
        else if ($percent >= 5)
            $size .= "1.0em;";
        else
            $size .= "0.8em;";
 
        return $size;
    }
 
    function showCloud($show_freq = false)
    {
        $this->max = max($this->words);
 
        $out = "";
        foreach ($this->words as $word => $freq)
        {
            if(!empty($word))
            {
                $size = $this->getSize(($freq / $this->max) * 100);
                if($show_freq) $disp_freq = "($freq)"; else $disp_freq = "";
 
                $out .= "<span style='font-family: Tahoma; padding: 4px 4px 4px 4px; letter-spacing: 3px; $size'>
                            &nbsp; {$word}<sup>$disp_freq</sup> &nbsp; </span>";
            }
        }
 
        return $out;
    }
 
}
include("./database/tb_media.php");

function cloudtag_layout()
{
    $keywords = get_keywords_in_media();
    $txt = "";
    if($keywords)
    {
        foreach($keywords as $keyword)
        {
            $temp = $keyword['keyword'].' ';
            $txt .= $temp;
        }
    }

    //$txt = "The The text to be turned into a cloud";
    $cloud = new WordCloud($txt);
    echo $cloud->showCloud(true);
}
?>

<div class="col-md-offset-2 main">
    <div class="main-grids">
	    <div class="top-grids">
	        <div class="recommended-info">
	            <h3>Cloudtag</h3>
            </div>
            <hr>
            <?php cloudtag_layout() ?>
		</div>
		</div>
	</div>
</div>
