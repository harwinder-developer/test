<?php
/**
 * List Table Class.
 *
 * @class       PP_EDD_Stripe_Organization_List
 * @version     1.0
 * @author lafif <hello@lafif.me>
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

if (!class_exists('WP_List_Table')) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}

/**
 * PP_EDD_Stripe_Organization_List class that will display our custom table
 */
class PP_EDD_Stripe_Organization_List extends WP_List_Table {

    private $table_name;

    /**
     * [REQUIRED] You must declare constructor and give some basic params
     */
    function __construct() {
        global $wpdb, $status, $page;

        $this->table_name = PP_EDD_ORG_TABLE;

        parent::__construct(array(
            'singular' => 'town',
            'plural' => 'towns',
        ));
    }

    /**
     * [REQUIRED] this is a default column renderer
     *
     * @param $item - row (key, value array)
     * @param $column_name - string (key)
     * @return HTML
     */
    function column_default($item, $column_name) {
        return $item[$column_name];
    }

    /**
     * [OPTIONAL] this is example, how to render column with actions,
     * when you hover row "Edit | Delete" links showed
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_name($item) {
        $actions = array(
            'edit' => sprintf('<a href="%s?page=%s&action=edit&id=%s">%s</a>', get_admin_url(get_current_blog_id(), 'admin.php'), $_REQUEST['page'], $item['id'], __('Edit', 'edds')),
            'delete' => sprintf('<a href="%s?page=%s&action=delete&id=%s">%s</a>', get_admin_url(get_current_blog_id(), 'admin.php'), $_REQUEST['page'], $item['id'], __('Delete', 'edds')),
        );

        return sprintf('%s %s',
            $item['name'],
            $this->row_actions($actions)
        );
    }

    /**
     * [REQUIRED] this is how checkbox column renders
     *
     * @param $item - row (key, value array)
     * @return HTML
     */
    function column_cb($item) {
        return sprintf(
            '<input type="checkbox" name="id[]" value="%s" />',
            $item['id']
        );
    }

    function column_logo($item){
        return sprintf('<img src="%s" style="width:100px;">', $item['logo']);
    }

    function column_stripe_id($item){
        return sprintf('<code>%s</code>', $item['stripe_id']);
    }
    
    /**
     * Add extra markup in the toolbars before or after the list
     * @param string $which, helps you decide if you add the markup after (bottom) or before (top) the list
     */
    // function extra_tablenav( $which ) {
    //    if ( $which == "top" ){
    //       //The code that goes before the table is here
    //       echo"Hello, I'm before the table";
    //    }
    //    if ( $which == "bottom" ){
    //       //The code that goes after the table is there
    //       echo"Hi, I'm after the table";
    //    }
    // }

    /**
     * [REQUIRED] This method return columns to display in table
     * you can skip columns that you do not want to show
     * like content, or description
     *
     * @return array
     */
    function get_columns() {
        $columns = array(
            'cb' => '<input type="checkbox" />', // Render a checkbox instead of text
            'name' => __('Name', 'edds'),
            'email' => __('Email', 'edds'),
            'tax_id' => __('Tax ID', 'edds'),
            'logo' => __('Logo', 'edds'),
            'donor_message' => __('Donor Message', 'edds'),
            'stripe_id' => __('Stripe ID', 'edds'),
        );
        return $columns;
    }

    /**
     * [OPTIONAL] This method return columns that may be used to sort table
     * all strings in array - is column names
     * notice that true on name column means that its default sort
     *
     * @return array
     */
    function get_sortable_columns() {
        $sortable_columns = array(
            'name' => array('name', true),
        );
        return $sortable_columns;
    }

    /**
     * [OPTIONAL] Return array of bult actions if has any
     *
     * @return array
     */
    function get_bulk_actions() {
        $actions = array(
            'delete' => 'Delete'
        );
        return $actions;
    }

    /**
     * [OPTIONAL] This method processes bulk actions
     * it can be outside of class
     * it can not use wp_redirect coz there is output already
     * in this example we are processing delete action
     * message about successful deletion will be shown on page in next part
     */
    function process_bulk_action() {
        global $wpdb;

        if ('delete' === $this->current_action()) {
            $ids = isset($_REQUEST['id']) ? $_REQUEST['id'] : array();
            if (is_array($ids)) $ids = implode(',', $ids);

            if (!empty($ids)) {
                $wpdb->query("DELETE FROM $this->table_name WHERE id IN($ids)");
            }
        }
    }

    /**
     * [REQUIRED] This is the most important method
     *
     * It will get rows from database and prepare them to be showed in table
     */
    function prepare_items() {
        global $wpdb;

        $per_page = 10; // constant, how much records will be shown per page

        $columns = $this->get_columns();
        $hidden = array();
        $sortable = $this->get_sortable_columns();

        // here we configure table headers, defined in our methods
        $this->_column_headers = array($columns, $hidden, $sortable);

        // [OPTIONAL] process bulk action if any
        $this->process_bulk_action();

        // prepare query params, as usual current page, order by and order direction
        $paged = isset($_REQUEST['paged']) ? max(0, intval($_REQUEST['paged']) - 1) : 0;
        $orderby = (isset($_REQUEST['orderby']) && in_array($_REQUEST['orderby'], array_keys($this->get_sortable_columns()))) ? $_REQUEST['orderby'] : 'id';
        $order = (isset($_REQUEST['order']) && in_array($_REQUEST['order'], array('asc', 'desc'))) ? $_REQUEST['order'] : 'desc';
        $search = (isset($_REQUEST['s'])) ? $_REQUEST['s'] : '';

        // will be used in pagination settings
        $total_items = $wpdb->get_var("SELECT COUNT(id) FROM $this->table_name WHERE name LIKE '%".$search."%'");

        $query = "SELECT * FROM {$this->table_name} t WHERE t.name LIKE '%".$search."%' ORDER BY $orderby $order LIMIT $per_page OFFSET $paged";
        
        // [REQUIRED] define $items array
        // notice that last argument is ARRAY_A, so we will retrieve array
        $this->items = $wpdb->get_results($query, ARRAY_A);
        // echo $wpdb->last_query;
        // [REQUIRED] configure pagination
        $this->set_pagination_args(array(
            'total_items' => $total_items, // total items defined above
            'per_page' => $per_page, // per page constant defined at top of method
            'total_pages' => ceil($total_items / $per_page) // calculate pages count
        ));
    }
}