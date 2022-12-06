<?php
namespace gi\lazy\checkvar;

class Examples
{
    function causeWarnings() {
        // variable warning
        $value = $price + 1;
        
        // element warning
        $business = [];
        $addstr = "";
        $addstr .= $business['phone'];
    }

    function naiveCheck()
    {
        $business = [ "phone" => "123" ];
/* listing 003.02 */
        if ($business['phone']) {
            print "doing something with {$business['phone']}";
        }
/* /listing 003.02 */
    }

    function emptyCheck() 
    {
        $business = [ "phone" => "321" ];
/* listing 003.03 */
        if (! empty($business['phone'])) {
            print "doing something with {$business['phone']}";
        }
/* /listing 003.03 */
    }

    function issetCheckNoSet()
    {
        if (isset($usernotes)) {
            return true;
        }
        return false;
    }

    function issetCheckValSet()
    {
        $usernotes = "hmm";
/* listing 003.04 */
        if (isset($usernotes)) {
            print "doing something with {$usernotes}\n";
        }
/* /listing 003.04 */
    }

    function directSetDefault($arr=[])
    {
/* listing 003.05 */
        if (! isset($arr['fruit0'])) {
            $arr['fruit0'] = "basic plums";
        }
/* /listing 003.05 */
        return $arr;
    }

    function ternarySetDefault($arr=[])
    {
/* listing 003.06 */
        $arr['fruit1'] = (isset($arr['fruit1'])) ? $arr['fruit1'] : "basic apples";
/* /listing 003.06 */
        return $arr;
    }

    function nullcoSetDefault($arr=[])
    {
/* listing 003.07 */
        $arr['fruit2'] = $arr['fruit2'] ?? "basic oranges";
/* /listing 003.07 */
        return $arr;
    }
    function nullcoassSetDefault($arr=[])
    {
/* listing 003.08 */
        $arr['fruit3'] ??= "basic grapes";
/* /listing 003.08 */
        return $arr;
    }
}

