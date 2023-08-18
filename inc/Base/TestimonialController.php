<?php
/**
* @package firstawesome-plugin
*/
namespace Inc\Base;

use Inc\Api\SettingsApi;
use Inc\Base\BaseController;
use Inc\Api\Callbacks\AdminCallbacks;

/**
* 
*/
class TestimonialController extends BaseController
{
	public $callbacks;

	public $subpages = array();

	public function register()
	{
		$opt = get_option( 'awesome_plugin' );
        $activated = isset($opt['testimonial_manager']) ? $opt['testimonial_manager'] : false;
		if ( ! $activated ) {
            return;
		}
		add_action( 'init', array( $this, 'testimonial_cpt' ) );
		add_action( 'add_meta_boxes', array( $this, 'add_meta_boxes' ) );
		add_action( 'save_post', array( $this, 'save_meta_box' ) );
	}

	public function testimonial_cpt ()
	{
		$labels = array(
			'name' => 'Testimonials',
			'singular_name' => 'Testimonial'
		);

		$args = array(
			'labels' => $labels,
			'public' => true,
			'has_archive' => false,
			'menu_icon' => 'dashicons-testimonial',
			'exclude_from_search' => true,
			'publicly_queryable' => false,
			'supports' => array( 'title', 'editor' )
		);

		register_post_type ( 'testimonial', $args );
	}

	public function add_meta_boxes()
	{
		add_meta_box(
			'testimonial_author',
			'Testimonial Options',
			array( $this, 'render_features_box' ),
			'testimonial',
			'side',
			'default'
		);
	}

	public function render_features_box($post)
	{
		wp_nonce_field( 'awesome_testimonial', 'awesome_testimonial_nonce' );

		$data = get_post_meta( $post->ID, '_awesome_testimonial_key', true );
		$name = isset($data['name']) ? $data['name'] : '';
		$email = isset($data['email']) ? $data['email'] : '';
		$approved = isset($data['approved']) ? $data['approved'] : false;
		$featured = isset($data['featured']) ? $data['featured'] : false;
		?>
		<p>
			<label class="meta-label" for="awesome_testimonial_author">Author Name</label>
			<input type="text" id="awesome_testimonial_author" name="awesome_testimonial_author" class="widefat" value="<?php echo esc_attr( $name ); ?>">
		</p>
		<p>
			<label class="meta-label" for="awesome_testimonial_email">Author Email</label>
			<input type="email" id="awesome_testimonial_email" name="awesome_testimonial_email" class="widefat" value="<?php echo esc_attr( $email ); ?>">
		</p>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="awesome_testimonial_approved">Approved</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="awesome_testimonial_approved" name="awesome_testimonial_approved" value="1" <?php echo $approved ? 'checked' : ''; ?>>
					<label for="awesome_testimonial_approved"><div></div></label>
				</div>
			</div>
		</div>
		<div class="meta-container">
			<label class="meta-label w-50 text-left" for="awesome_testimonial_featured">Featured</label>
			<div class="text-right w-50 inline">
				<div class="ui-toggle inline"><input type="checkbox" id="awesome_testimonial_featured" name="awesome_testimonial_featured" value="1" <?php echo $featured ? 'checked' : ''; ?>>
					<label for="awesome_testimonial_featured"><div></div></label>
				</div>
			</div>
		</div>
		<?php
	}

	public function save_meta_box($post_id)
	{
		if (! isset($_POST['awesome_testimonial_nonce'])) {
			return $post_id;
		}

		$nonce = $_POST['awesome_testimonial_nonce'];
		if (! wp_verify_nonce( $nonce, 'awesome_testimonial' )) {
			return $post_id;
		}

		if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
			return $post_id;
		}

		if (! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

		$data = array(
			'name' => sanitize_text_field( $_POST['awesome_testimonial_author'] ),
			'email' => sanitize_text_field( $_POST['awesome_testimonial_email'] ),
			'approved' => isset($_POST['awesome_testimonial_approved']) ? 1 : 0,
			'featured' => isset($_POST['awesome_testimonial_featured']) ? 1 : 0,
		);
		update_post_meta( $post_id, '_awesome_testimonial_key', $data );
	}
}