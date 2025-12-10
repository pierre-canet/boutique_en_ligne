<?php
function admin_index()
{
    $data = [];
    load_view_with_layout('admin/index', $data, 'admin_layout');
}
