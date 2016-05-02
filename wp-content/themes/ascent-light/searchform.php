<?php
$label = '';
if (is_search() ) {
    $label = '<label for="s">' . __('Search again', 'ascent-light') . ': </label>';
}

$form = '<form method="get" id=searchform" class="search-form" action="' . esc_url(home_url('/')) . '">
'. $label .'<input type="text" id="s" name="s" placeholder="' . esc_attr_x('Search', 'placeholder', 'ascent-light') . '" value="' . get_search_query() . '" title="' . _x('Search for:', 'label', 'ascent-light') . '" />
</form>';

echo $form;