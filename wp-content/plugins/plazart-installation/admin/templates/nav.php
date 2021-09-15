<?php
/**
 * Base layout for all admin pages
 */

if(isset($nav_tabs) && $nav_tabs){
?>
<nav class="plzinst-nav-bar mb-5">
    <ul>
        <?php foreach( $nav_tabs as $tab_id => $tab_info ) {
//            var_dump($tab_info);
            $feature_tab_class  = $type === $tab_id ? 'plzinst-nav-tab plzinst-tab-active' : 'plzinst-nav-tab';
            $feature_tab_class .= ' plzinst-tab-' . $tab_id;
            $target = ! empty( $tab_info['target'] ) ? $tab_info['target'] : '_self';
            ?>
            <li class="<?php echo esc_attr( $feature_tab_class )?>">
                <a href="<?php echo esc_url( $tab_info['url'] ); ?>" target="<?php echo esc_attr( $target ); ?>">
                    <?php echo $tab_info['label']; ?>
                </a>
            </li>
        <?php } ?>
    </ul>
</nav>
<?php } ?>