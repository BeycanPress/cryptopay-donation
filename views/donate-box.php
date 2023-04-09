
<div class="cp-donation-container theme-<?php echo esc_attr($theme) ?>" data-currency="<?php echo esc_attr($currency) ?>">
    <div class="donation-box">
        <div class="title"><?php echo esc_html__('Choose donate amount', 'cryptopay') ?></div>
        
        <div class="amount">
            <?php if ($amounts) : ?>
                <?php foreach (array_column($amounts, 'value') as $value) : ?>
                    <div class="choose-donate" data-value="<?php echo $value ?>">
                        <?php echo $value ?> <?php echo esc_html($currency) ?>
                    </div>
                <?php endforeach; ?>
            <?php else : ?>
                <div class="choose-donate" data-value="30">30 <?php echo esc_html($currency) ?></div>
                <div class="choose-donate" data-value="50">50 <?php echo esc_html($currency) ?></div>
                <div class="choose-donate" data-value="100">100 <?php echo esc_html($currency) ?></div>
            <?php endif; ?>
            <div class="choose-donate" data-value="0">
                <input type="number" class="set-amount" min="1" /> 
                <?php echo esc_html($currency) ?>
            </div>
        </div>
        
        <div class="donate-button">
            <i class="far fa-project-diagram"></i> 
            <?php echo esc_html__('Select network', 'cryptopay') ?>
        </div>
    </div>
</div>