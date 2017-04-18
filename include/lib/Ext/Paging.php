<?
/*
 * Title: paging functions
 *
 * @author Eugene Cherkassky
 * @email i@cherkassky.kiev.ua
 * @version 2.0
 */

function getLink($title, $url, $isLink=true) {
    return ($isLink)
        ? '[<a href="' . $url . '">' . $title . '</a>]'
        : '[<span class="active">' . $title . '</span>]';
}

function getPaging(
            $offset,	//page offset
            $rpp,		//records per page
            $lpp,		//lines per page
            $total,		//total records
            $hidden = array(),
            $offsetParamName = 'offset') {

    if (intval($total) == 0) {
        return translate('No items present');
    }

    $offset = ($offset > $total) ? $total : abs((int)$offset);

    $result = translate('Total') . ': ' . $total . ' ';

    $hiddens = '';

    foreach ($hidden as $name => $value) {
        //if ($name != 'do')
        if (is_array($value)) {
            $hiddens .= '&amp;' . $name . '[]=' . implode('&amp;' . $name . '[]=', $value);
        } else {
            $hiddens .= '&amp;' . $name . '=' . $value;
        }
    }

    $pageNumber = (int)($offset/($rpp*$lpp));
    $startOff = $rpp * $lpp * $pageNumber;

    $serverUrl = $_SERVER['PHP_SELF'];
    //	$serverUrl = $_SERVER['REDIRECT_URL'];

    if($startOff > 0) {
        $result .= getLink("&#171;&#171;", $serverUrl."?$offsetParamName=0$hiddens");
        $result .= getLink("&#171;&#171;",  $serverUrl."?$offsetParamName=".($startOff-$rpp)."$hiddens");
    }

    $endOff = min($total, $startOff + $rpp*$lpp);

    for($off = $startOff, $i = 1; $off < $endOff; $i++, $off = $startOff + $rpp*($i-1)) {
        $result .= getLink(($off+1) . "-" . min($off+$rpp, $endOff), $serverUrl."?$offsetParamName=$off$hiddens", !($off == $offset));
    }

    if($endOff < $total) {
        $endPageNumber	=	(int)(($total-1)/($rpp*$lpp));
        $endStartOff	=	$rpp * $lpp * $endPageNumber;
        $result			.=	getLink("&#187;&#187;", $serverUrl."?$offsetParamName=$endOff$hiddens");
        $result			.=	getLink("&#187;&#187;", $serverUrl."?$offsetParamName=$endStartOff$hiddens" );
    }
    return $result;
}

function getLinkNavigation($title, $url, $isLink=true) {
    return ($isLink)
        ? '<a href="' . $url . '">' . $title . '</a>'
        : '<a href="' . $url . '" class="active">' . $title . '</a>';
}

function getPagingNavigation($params) {
    $total		= $params['total'];
    $offset		= $params['data']['offset'];
    $rpp		= ($params['rpp']) ? $params['rpp'] : DEFAULT_RPP;
    $lpp                = ($params['lpp']) ? $params['lpp'] : DEFAULT_LPP;
    $offsetParamName	= ($params['offsetParamName']) ? $params['offsetParamName'] : 'offset';

    if (intval($total) == 0 && $params['empty']) {
        return translate('No items present');
    } elseif (intval($total) <= DEFAULT_LPP) {
        return '';
    } else {

        $offset = ($offset > $total) ? $total : abs((int)$offset);

        $result = '<span class="title">' . translate('Pages') . '</span>: ';

        $hiddens = '';

        if (is_array($params['data'])) {
            foreach ($params['data'] as $field => $value) {
                if (ereg('q', $field))
                    $hiddens .= '&amp;' . $field . '=' . $value;
            }
        }

        $pageNumber = (int)($offset/($rpp*$lpp));
        $startOff = $rpp * $lpp * $pageNumber;

        if ($startOff > 0) {
            $result .= getLinkNavigation("&#171;&#171;", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']."?$offsetParamName=0$hiddens");
            $result .= getLinkNavigation("&#171;",  'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']."?$offsetParamName=".($startOff-$rpp)."$hiddens");
        }

        $endOff = min($total, $startOff + $rpp*$lpp);

        for($off = $startOff, $i = 1; $off < $endOff; $i++, $off = $startOff + $rpp*($i-1)) {
            $result .= getLinkNavigation($i + $pageNumber * $rpp, 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']."?$offsetParamName=$off$hiddens", !($off == $offset));
        }

        if($endOff < $total) {
            $endPageNumber	=	(int)(($total-1)/($rpp*$lpp));
            $endStartOff	=	$rpp * $lpp * $endPageNumber;
            $result		.=	getLinkNavigation("&#187;", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']."?$offsetParamName=$endOff$hiddens");
            $result		.=	getLinkNavigation("&#187;&#187;", 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REDIRECT_URL']."?$offsetParamName=$endStartOff$hiddens" );
        }
    }
    return '<div class="navigation">' . $result . '</div>';
}

?>