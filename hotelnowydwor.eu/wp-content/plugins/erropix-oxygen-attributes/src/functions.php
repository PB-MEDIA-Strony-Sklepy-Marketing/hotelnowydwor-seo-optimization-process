<?php

function oxyatts_fs()
{
    global  $oxyatts_fs ;
    if ( !isset( $oxyatts_fs ) ) {
        $oxyatts_fs = fs_dynamic_init( [
            'id'               => '4466',
            'slug'             => 'erropix-oxygen-attributes',
            'premium_slug'     => 'erropix-oxygen-attributes',
            'type'             => 'plugin',
            'public_key'       => 'pk_f6a378861d4df8828f59e46f4f1b0',
            'is_premium'       => true,
            'is_premium_only'  => true,
            'has_addons'       => false,
            'is_org_compliant' => false,
            'has_paid_plans'   => true,
            'trial'            => [
            'days'               => 7,
            'is_require_payment' => true,
        ],
            'menu'             => [
            'slug'    => 'oxygen-attributes',
            'account' => false,
            'support' => false,
            'contact' => false,
            'parent'  => [
            'slug' => 'ct_dashboard_page',
        ],
        ],
            'is_live'          => true,
        ] );
    }
    return $oxyatts_fs;
}
