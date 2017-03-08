<?php defined( 'ABSPATH' ) OR die( 'This script cannot be accessed directly.' );

/**
 * Output a form's hidden field
 *
 * @var $name  string Field name
 * @var $value string Field value
 *
 * @action Before the template: 'wlgx_before_template:templates/form/hidden'
 * @action After the template: 'wlgx_after_template:templates/form/hidden'
 * @filter Template variables: 'wlgx_template_vars:templates/form/hidden'
 */

$name = isset( $name ) ? $name : '';
$value = isset( $value ) ? $value : '';

?>
<input type="hidden" name="<?php echo esc_attr( $name ) ?>" value="<?php echo esc_attr( $value ) ?>" />
