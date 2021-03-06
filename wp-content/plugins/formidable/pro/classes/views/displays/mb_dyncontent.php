<p><label for="options_no_rt"> <input type="checkbox" id="options_no_rt" name="options[no_rt]" value="1" <?php checked($post->frm_no_rt, 1) ?> /> <?php _e('Disable visual editor for this view', 'formidable') ?></label> <span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php _e('It is recommended to check this box if you include a &lt;table&gt; tag in the Before Content box.', 'formidable') ?>" ></span></p>
<p>
<label><?php _e('Before Content', 'formidable'); ?> <span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php _e('This content will not be repeated. This would be a good place to put any HTML table tags.', 'formidable') ?>" ></span> (<?php _e('optional', 'formidable') ?>)
<textarea id="before_content" name="options[before_content]" rows="3" style="width:98%"><?php echo FrmAppHelper::esc_textarea($post->frm_before_content) ?></textarea>
</label>
</p>


<div>
<label><?php _e('Content', 'formidable'); ?> <span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php _e('The HTML for your page. If \'All Entries\' is selected above, this content will be repeated for each entry. The field ID and Key work synonymously, although there are times one choice may be better. If you are panning to copy your view settings to other blogs, use the Key since they will be copied and the ids may differ from blog to blog.', 'formidable') ?>" ></span></label>


<div id="<?php echo (!$post->frm_no_rt && user_can_richedit()) ? 'postdivrich' : 'postdiv'; ?>" class="postarea frm_full_rte">
<?php wp_editor( $post->post_content, 'content', $editor_args ); ?>
</div>
</div>
    

<p>
<label><?php _e('After Content', 'formidable'); ?> <span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php _e('This content will not be repeated. This would be a good place to close any HTML tags from the Before Content field.', 'formidable') ?>" ></span> (<?php _e('optional', 'formidable') ?>)
<textarea id="after_content" name="options[after_content]" rows="3" style="width:98%"><?php echo FrmAppHelper::esc_textarea($post->frm_after_content) ?></textarea>
</label>
</p>

    
<div class="hide_dyncontent <?php echo in_array($post->frm_show_count, array('dynamic', 'calendar')) ? '' : 'frm_hidden'; ?>">
    <label><?php _e('Dynamic Content', 'formidable'); ?> <span class="frm_help frm_icon_font frm_tooltip_icon" title="<?php printf(__('The HTML for the entry on the dynamic page. This content will NOT be repeated, and will only show when the %1$s is clicked.', 'formidable'), '[detaillink]') ?>" ></span></label>
    <?php wp_editor( $post->frm_dyncontent, 'dyncontent', $editor_args ); ?>
</div>