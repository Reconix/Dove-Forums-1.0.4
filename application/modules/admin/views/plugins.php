<?php (defined('BASEPATH')) OR exit('No direct script access allowed');?>

<div class="header_bg"><h1><?php echo $this->lang->line('plugins'); ?></h1></div>
<div class="content_box">
<table border="0" cellpadding="0" cellspacing="0" class="table">
<thead>
<tr>
<th>Plugin Name</th><th>Plugin Description</th><th>Plugin Author</th><th>Plugin Version</th><th>Install/Uninstall</th>
</tr>
</thead>
<tbody>
<?php
foreach($plugins as $row)
{    
    $plugin = $this->plugins->plugin_info($row['name']);
    
    $this->db->select('plugin_system_name');
    $options = array(
        'plugin_system_name' => $row['name'],
    );
    $q = $this->db->get_where('plugins', $options);
    
    if($q->num_rows() >0)
    {
        $plugin_installed = '1';
    }
    else
    {
        $plugin_installed = '0';
    }
    
    echo '<tr>';
    echo '<td>'.$plugin['plugin_name'].'</td>';
    echo '<td>'.$plugin['plugin_description'].'</td>';
    echo '<td>'.anchor($plugin['plugin_uri'], $plugin['plugin_author']).'</td>';
    echo '<td>'.$plugin['plugin_version'].'</td>';
    if($plugin_installed == '1')
    {
        echo '<td>'.anchor('core/uninstall_plugin/'.$row['name'].'', 'Uninstall').'</td>';
    }
    else
    {
        echo '<td>'.anchor('core/install_plugin/'.$row['name'].'', 'Install').'</td>';
    }    
    
    
    echo '</tr>';
}
?>
</tbody>
</table>

</div>