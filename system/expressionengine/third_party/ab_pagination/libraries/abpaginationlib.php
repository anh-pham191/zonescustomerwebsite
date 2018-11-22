<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');


/**
 * Segments/URL related functions
 */
class Abpaginationlib
{
    private $padding_left = 3;
    private $padding_right = 3;
    private $initial_size = FALSE;
    private $fixed_size = FALSE;


    public function __construct()
    {
        $this->EE = get_instance();
    }

    public function render_pagination($tag_prefix, $paginate_base, $current_uri_string, $count, $per_page, $current_page_num, $query_string, $paginate_location, $template_partial) {
        $matches = array();             // (switch\s*=.+?)
        if(preg_match_all('/\{'.$tag_prefix.'pages( (\w+)\=["|\']([0-9|no]+)["|\'])?( (\w+)\=["|\']([0-9|no]+))?["|\']( (\w+)\=["|\']([0-9|no]+)["|\'])?( (\w+)\=["|\']([0-9|no]+)["|\'])?\}/i', $template_partial, $matches, PREG_SET_ORDER))
        {
            $current_index = 2;

            $found_matches = $matches[0];

            while($current_index < count($found_matches))
            {
                switch($found_matches[$current_index])
                {
                    case 'padding':
                        $this->padding_left = $this->padding_right = $found_matches[$current_index+1];
                        break;

                    case 'padding_left':
                        $this->padding_left = intval($found_matches[$current_index+1]);
                        break;

                    case 'padding_right':
                        $this->padding_right = intval($found_matches[$current_index+1]);
                        break;

                    case 'initial_size':
                        $this->initial_size = intval($found_matches[$current_index+1]);
                        break;

                    case 'fixed_size':
                        $this->fixed_size = intval($found_matches[$current_index+1]);
                        break;
                }

                $current_index += 3;
            }
        }

        $pages = array();

        if($paginate_base)
        {
            $pagination_base_url = $this->EE->functions->create_url(trim_slashes($this->EE->TMPL->fetch_param('paginate_base')));
        }
        else
        {
            $pagination_base_url = trim($this->EE->functions->create_url($current_uri_string), '/');
        }

        $num_pages = ceil($count/$per_page);
        $previous = FALSE;

        if($this->padding_left != 'no')
        {
            $start_pagination_on = $current_page_num - $this->padding_left;
            $end_pagination_on = $current_page_num + $this->padding_right + 1;

            if($start_pagination_on < 0)
            {
                $start_pagination_on = 0;
            }

        }
        else
        {
            $start_pagination_on = 0;
            $end_pagination_on = $num_pages;
        }

        if(!$this->initial_size && $this->fixed_size)
        {
            $this->initial_size = $this->fixed_size;
        }

        if($this->fixed_size)
        {
            $start_pagination_on = $current_page_num - floor($this->fixed_size/2);
            $end_pagination_on = $current_page_num + ceil(($this->fixed_size)/2);
            if($end_pagination_on > $num_pages)
            {
                $end_pagination_on = $num_pages;
                $start_pagination_on = $num_pages - $this->fixed_size;
            }


            if($start_pagination_on < 0)
            {
                $start_pagination_on = 0;
            }
        }

        if($this->initial_size && $end_pagination_on < $this->initial_size)
        {
            $end_pagination_on = $this->initial_size;
        }

        if($end_pagination_on > $num_pages)
        {
            $end_pagination_on = $num_pages;
        }

        for($j=$start_pagination_on; $j<$end_pagination_on; $j++)
        {
            $add_uri = '';
            if($j>0)
            {
                $add_uri = "/P".($j*$per_page);
            }

            $current_p_val = ($j*$per_page);

            $current = array(
                $tag_prefix.'is_current' => $j == $current_page_num,
                $tag_prefix.'link' => $pagination_base_url.$add_uri,
                $tag_prefix.'link_p_only' => 'P'.$current_p_val,
                $tag_prefix.'current_p' => $current_p_val,
                $tag_prefix.'num' => $j+1,
                $tag_prefix.'previous_link' => '',
                $tag_prefix.'previous_link_p_only' => '',
                $tag_prefix.'previous_num' => FALSE,
                $tag_prefix.'previous_p' => FALSE,
                $tag_prefix.'has_previous' => FALSE,
                $tag_prefix.'is_last_page' => ($j == ($num_pages-1)),
                $tag_prefix.'is_first_page' => ($j == 0),
                $tag_prefix.'has_next' => ($j<$end_pagination_on),
                $tag_prefix.'next_link' => '',
                $tag_prefix.'next_link_p_only' => '',
                $tag_prefix.'next_num' => FALSE,
                $tag_prefix.'next_p' => FALSE,
            );

            if($current[$tag_prefix.'has_next'])
            {
                $next_p_val = ($j+1)*$per_page;
                $current[$tag_prefix.'next_link'] = $pagination_base_url.'/P'.$next_p_val;
                $current[$tag_prefix.'next_num'] = $j+2;
                $current[$tag_prefix.'next_link_p_only'] = 'P'.$next_p_val;
                $current[$tag_prefix.'next_p'] = $next_p_val;
            }

            if($previous)
            {
                $previous_p_val = $previous[$tag_prefix.'current_p'];
                $current[$tag_prefix.'previous_link'] = $previous[$tag_prefix.'link'];
                $current[$tag_prefix.'previous_num'] = $previous[$tag_prefix.'num'];
                $current[$tag_prefix.'previous_link_p_only'] = 'P'.$previous_p_val;
                $current[$tag_prefix.'has_previous'] = TRUE;
                $current[$tag_prefix.'previous_p'] = $previous_p_val;
            }

            $pages[] = $current;
            $previous = $current;
        }

        $entry_from = $current_page_num*$per_page+1;
        $entry_to = $current_page_num*$per_page + $per_page;
        if($entry_to > $count) { $entry_to = $count; }

        $vars = array(
            $tag_prefix.'pages' => $pages,
            $tag_prefix.'total_pages' => $num_pages,
            $tag_prefix.'per_page' => $per_page,
            $tag_prefix.'total_entries' => $count,
            $tag_prefix.'first_link' => $pagination_base_url,
            $tag_prefix.'last_page_not_linked' => !($end_pagination_on == $num_pages),
            $tag_prefix.'query_string' => $query_string,
            $tag_prefix.'entry_from' => $entry_from,
            $tag_prefix.'entry_to' => $entry_to,
        );

        if($num_pages > 1)
        {
            $vars[$tag_prefix.'last_link'] = $pagination_base_url.'/P'.(($num_pages-1)*$per_page);
        }
        else
        {
            $vars[$tag_prefix.'last_link'] = $pagination_base_url;
        }

        $vars[$tag_prefix.'current_page_num'] = $current_page_num;
        $vars[$tag_prefix.'current_page_num_liber'] = $current_page_num+1;
        $vars[$tag_prefix.'current_p'] = ($current_page_num * $per_page);

        if($current_page_num <= $start_pagination_on)
        {
            $vars[$tag_prefix.'has_previous'] = FALSE;
            $vars[$tag_prefix.'previous_link'] = '';
            $vars[$tag_prefix.'previous_page_num'] = FALSE;
            $vars[$tag_prefix.'previous_page_num_liber'] = FALSE;
            $vars[$tag_prefix.'previous_p'] = FALSE;
        }
        else
        {
            $vars[$tag_prefix.'has_previous'] = TRUE;
            $vars[$tag_prefix.'previous_link'] = $pages[$current_page_num-1-$start_pagination_on][$tag_prefix.'link'];
            $vars[$tag_prefix.'previous_page_num'] = $current_page_num-1;
            $vars[$tag_prefix.'previous_page_num_liber'] = $current_page_num;
            $vars[$tag_prefix.'previous_p'] = ($current_page_num-1)*$per_page;
        }

        if(round($current_page_num) >= $end_pagination_on-1)
        {
            $vars[$tag_prefix.'has_next'] = FALSE;
            $vars[$tag_prefix.'next_link'] = '';
            $vars[$tag_prefix.'next_page_num'] = $num_pages;
            $vars[$tag_prefix.'next_page_num_liber'] = $num_pages;
            $vars[$tag_prefix.'next_p'] = FALSE;
        }
        else
        {
            $vars[$tag_prefix.'has_next'] = TRUE;
            $vars[$tag_prefix.'next_link'] = $pages[$current_page_num+1-$start_pagination_on][$tag_prefix.'link'];
            $vars[$tag_prefix.'next_page_num'] = $current_page_num+1;
            $vars[$tag_prefix.'next_page_num_liber'] = $current_page_num+2;

            $vars[$tag_prefix.'next_p'] = ($current_page_num+1)*$per_page;
        }

        $pagination_html =  $this->EE->TMPL->parse_variables($template_partial, array($vars));

        if($paginate_location == 'custom') {

            if(count($pages) <= 1) {
                $pagination_html = '';
            }
            $this->EE->config->_global_vars[$tag_prefix.'pagination_html'] = $pagination_html;
            $this->EE->config->_global_vars[$tag_prefix.'_all_vars'] = serialize($vars);
            $pagination_html = '';
        }

        return $pagination_html;
    }
}