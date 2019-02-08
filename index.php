function add_drafts_admin_menu_item() {
  // $page_title, $menu_title, $capability, $menu_slug, $callback_function
  add_posts_page(__('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=post');
}
add_action('admin_menu', 'add_drafts_admin_menu_item');
