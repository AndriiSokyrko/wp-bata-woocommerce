<?php
	class Custom_Walker_Naw_Menu extends Walker_Nav_Menu {

		// add classes to ul sub-menus
		function start_lvl( &$output, $depth = 0, $args = array() ) {
//			$output .= '<div class="dropdown-menu dropdown-menu-right" aria-labelledby="menu-/posts">';
		}

		function end_lvl( &$output, $depth = 0, $args = array() ) {
//			$output .= '</div></li>';
		}

		// add main/sub classes to li's and links
		function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
			$html='';
			if ( $item->title != "search" ) {
				$html .= '<li>
                <a href="' . $item->url . '" title="' . $item->title . '"><span class="line">' . $item->title . '</span></a>
            </li>';
			} else

			  {
				$html .= '
				<li class="dropdown">
			<a class="dropdown-toggle" href="'.$item->url.'" type="button" data-toggle="dropdown" aria-haspopup="true" 
			aria-expanded="true" target="_blank">
				<img class="img-responsive" src="'. get_template_directory_uri().'/icons/icon-search.png" alt="search">
			</a>
			<ul class="dropdown-menu">'.
				   get_search_form(false)

			.'</ul>
		</li>
				';
			
			}
//
			$output .=   $html ;

		}

		function end_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {

		}
	}


?>