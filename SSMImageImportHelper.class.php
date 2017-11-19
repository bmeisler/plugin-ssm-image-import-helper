<?php

namespace SSMImageImportHelper;

/**
 * main class for the Wordpress plugin SSMImageImportHelper
 * Cleans up images when imported into the Wordpress Media Library
 * 1. makes filenames url compliant
 * 2. makes file Titles human readable
 * 3. automatically creates an Alt tag (copies the Title)
 * Class ImageImportHelper
 * @package SSMImageImportHelper
 */
class ImageImportHelper {
	
	   /**
     * Holds an instance of the object
     *
     * @var ImageImportHelper
     **/
    private static $instance = null;

	private $urlutils;

    /**
     * Returns the running object - implements the Singleton design pattern
     *
     * @return ImageImportHelper
     **/

	public static function ssm_imageimporthelper_init(){
        is_null( self::$instance ) AND self::$instance = new self;
        return self::$instance;
    }
    public static function ssm_imageimporthelper_on_activation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "activate-plugin_{$plugin}" );
    }
    public static function ssm_imageimporthelper_on_deactivation()
    {
        if ( ! current_user_can( 'activate_plugins' ) )
            return;
        $plugin = isset( $_REQUEST['plugin'] ) ? $_REQUEST['plugin'] : '';
        check_admin_referer( "deactivate-plugin_{$plugin}" );
    }
    private function __construct(){
        require_once SSMIMAGEIMPORTHELPER_PLUGIN_DIR . 'inc/URLUtils.php';
		$this->urlutils = new \SSMImageImportHelper\URLUtils();
		add_filter('sanitize_file_name', array( $this, 'ssm_iih_cleanUpFileName'));
		add_action( 'add_attachment', array( $this, 'ssm_iih_cleanUpTitle' ) );
		add_action( 'add_attachment', array( $this, 'ssm_iih_addAltTag' ) );
    }

	/**
	 * Filter special characters from image name and return the lower case version.
	 * Converts the filename to a url compliant slug
	 *
	 * @param string $filename
	 * @return string
	 */
	function ssm_iih_cleanUpFileName($filename) {

		//get the file extension (.jpg, .png, etc) and save it for later
		$ext = $this->urlutils->ssm_iih_getExtension($filename);

		//remove the extensions
		$name = basename($filename, $ext);

		//clean up the filename for url compliance and then add the extension back on
		return  $this->urlutils->ssm_iih_sluggify($name) . $ext;
	}
	/**
	 * Cleans up bad characters from the title
	 * Preserves capitalization and apostrophes to create human-friendly Titles
	 * @param $post_id
	 */
	function ssm_iih_cleanUpTitle($post_id) {
		$uploaded_post_id = get_post($post_id);
		$title = $uploaded_post_id->post_title;

		$title = $this->urlutils->ssm_iih_titlify($title);

		// update the post
		$uploaded_post = array();
		$uploaded_post['ID'] = $post_id;
		$uploaded_post['post_title'] = $title;

		wp_update_post($uploaded_post);
	}

	/**
	 * sets the Alt tag equal to the Title
	 * @param $post_id
	 */
	function ssm_iih_addAltTag($post_id){
		$uploaded_post_id = get_post($post_id);
		$title = $uploaded_post_id->post_title;
		update_post_meta($post_id, '_wp_attachment_image_alt', $title);
	}

}
