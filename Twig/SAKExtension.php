<?php


namespace Aldaflux\SwissArmyKnifeBundle\Twig;

class SAKExtension extends \Twig_Extension 
{   

    public function getName()
    {
        return 'sakextension';
    }
    
    
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('progressBar', array($this, 'progressBar')),
            new \Twig_SimpleFilter('progressBarNotCent', array($this, 'progressBarNotCent')),
            new \Twig_SimpleFilter('getIconFile', array($this, 'GetIconFile')),
            new \Twig_SimpleFilter('highlightText', array($this, 'highlightText')),
            new \Twig_SimpleFilter('formatBytes', array($this, 'formatBytes')),
            new \Twig_SimpleFilter('limitChar', array($this, 'limitChar')),
            new \Twig_SimpleFilter('similarText', array($this, 'similarText')),
            new \Twig_SimpleFilter('similarTextTd', array($this, 'similarTextTd')),
             new \Twig_SimpleFilter('httpShort', array($this, 'httpShort')),
            );
    }


    

       
    
    public function httpShort($url)
    {
        
        $reponse=parse_url($url, PHP_URL_SCHEME);
        $reponse.="://".parse_url($url, PHP_URL_HOST);
        if (parse_url($url, PHP_URL_PATH)) $reponse.="...";
        return ($reponse);
    }
    
    
    public function similarText($value1,$value2)
    {
        return (similar_text($value1,$value2));
    }
    
    public function similarTextTd($value1,$value2)
    {
        $indice=similar_text($value1,$value2);
        if ($indice==101) $class="alert-success";
        elseif ($indice>90) $class="alert-info";
        elseif ($indice>60) $class="";
        elseif ($indice>20) $class="alert-warning";
        else $class="alert-danger";
        return (" <td class='".$class."' data-order='".$indice."'>".$indice." %</td>");
    }
    
    
    
    public function progressBar($progress)
    {
        if ($progress==100) $progress_bar_class="progress-bar-success";
        elseif ($progress==0) $progress_bar_class="progress-bar-danger";
        else $progress_bar_class="progress-bar-warning";
        
        $statut_rep= "<span class='hidden'>".str_pad($progress, 3, "0", STR_PAD_LEFT)."</span>";
        
        $statut_rep.=' <div class="progress">
                        <div class="progress-bar '.$progress_bar_class.'" role="progressbar" aria-valuenow="'.$progress.'"
                        aria-valuemin="0" aria-valuemax="100" style="width:'.$progress.'%">
                          <span  >'.$progress.'% Complète</span>
                        </div>
                      </div>';
        return ($statut_rep);
    }
    
    public function progressBarNotCent($val,$total)
    {
        $progress=round(($val/$total)*100,0,PHP_ROUND_HALF_DOWN);
        return ($this->progressBar($progress));
    }
    
    
    
    public function highlightText($text,$word,$color="yellow")
    {
        $word_motif = '`(\b)('.$word.')(\b)`i';
        $word_out = '<span style=\'background-color:'.$color.';\'>'.$word.'</span>';
        $texteSurligne = preg_replace($word_motif, $word_out, $text);
        return($texteSurligne);
    }
    
    public function getIconFile($file,$onlyicon=false)
    {
        switch (pathinfo($file, PATHINFO_EXTENSION))
        {
            case "pdf":
                  $icon='icon-file-pdf';
                break;
            case "doc":
            case "docx":
                  $icon='icon-file-word';
                break;
            case "xls":
            case "xlsx":
                  $icon='icon-file-excel';
                break;
            case "ptt":
                  $icon='icon-file-powerpoint';
                break;
            case "png":
            case "jpeg":
            case "jpg":
            case "gif":
                  $icon='icon-file-image';
                break;
            default:
                  $icon='icon-file-archive';
        }
        if ($onlyicon) return("<i class='".$icon."'></i>");        
        else return("<i class='".$icon."'></i>".$file);        
    }
    
            
            
    
    
    
    public function formatBytes($size, $precision = 1) { 
        if ($size >= 1073741824) 
            {
                $fileSize = round($size / 1024 / 1024 / 1024,$precision) . 'GB';
            }
            elseif ($size >= 1048576) 
            {
                $fileSize = round($size / 1024 / 1024,$precision) . 'MB';
            } 
            elseif($size >= 1024) {
                $fileSize = round($size / 1024,$precision) . 'KB';
        } 
        else 
        {
            $fileSize = $size . 'B';
        }
        return $fileSize;
    }
    
    
    public function limitChar($string,$nb,$strict=false)
    {
        if (strlen($string)<=$nb) return ($string);
        elseif ($strict)
        {
            return (substr($string,0,$nb)."…");
        }
        else
        {
            for ($i=$nb;$i>0;$i--)
            {
                if (substr($string,$i,1)==" ") 
                {
                    return (substr($string,0,$i)."…");
                }
            }
            return ($string);
        }
    }
    
    
    
}