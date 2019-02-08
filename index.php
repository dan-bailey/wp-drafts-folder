function add_drafts_admin_menu_item() {
  // adds "Drafts" to the Posts menu in the Admin view
  add_posts_page(__('Drafts'), __('Drafts'), 'read', 'edit.php?post_status=draft&post_type=post');
}
add_action('admin_menu', 'add_drafts_admin_menu_item');
