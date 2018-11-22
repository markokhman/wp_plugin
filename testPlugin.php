<?php

/*
	Plugin Name: Testplugin
	Description: Adds a new menu entry and gives a overview of all posts
	Author: Robin
*/

if ( ! defined( 'ABSPATH' ) ) exit;

class TestPlugin {

	function __construct() {

		register_activation_hook(__FILE__, array($this, "activate"));
		register_deactivation_hook(__FILE__, array($this, "deactivate"));
		register_uninstall_hook(__FILE__, array("TestPlugin", "uninstall"));
		add_action("admin_menu", array($this, "menu"));

	}

	function activate() {

		// $conn = mysqli_connect("localhost", "wordpress", "wordpress");
		// mysqli_query($conn, "CREATE DATABASE testi");
		// mysqli_close($conn);
	}

	function deactivate() {

		// $conn = mysqli_connect("localhost", "wordpress", "wordpress");
		// mysqli_query($conn, "DROP DATABASE testi");
		// mysqli_close($conn);
	}

	static function uninstall () {

		// $conn = mysqli_connect("localhost", "wordpress", "wordpress");
		// mysqli_query($conn, "DROP DATABASE testika");
		// mysqli_close($conn);
	}


	function menu() {

		add_menu_page(

			"My Plugin",
			"My Plugin",
			"manage_options",
			"PluginSlug",
			array($this, "pluginWebsite")
		);
		add_submenu_page(

			get_admin_page_parent(),
			"SubPageTitle",
			"My SubPlugin",
			"manage_options",
			"SubPluginSlug",
			array($this, "subPluginWebsite")
		);

	}

	function pluginWebsite() {

		// Access the posts
		$args = array(
			'posts_per_page'   => 5,
			'offset'           => 0,
			'category'         => '',
			'category_name'    => '',
			'orderby'          => 'date',
			'order'            => 'DESC',
			'include'          => '',
			'exclude'          => '',
			'meta_key'         => '',
			'meta_value'       => '',
			'post_type'        => 'post',
			'post_mime_type'   => '',
			'post_parent'      => '',
			'author' 		   => '',
			'author_name'	   => '',
			'post_status'      => 'publish',
			'suppress_filters' => true,
			'fields'           => '',
		);
		$post_array = get_posts($args);

		?>
		<body>
			<div>
				<center>
					<h1>Posts</h1>
					<table border="1">
						<tr><td><b>Headline</b></td><td><b>Content</b></td></tr>
						<?php
						foreach ($post_array as $post_object) {

							$title = $post_object->post_title;
							$content = $post_object->post_content;

							echo "<tr><td>". $title ."</td><td>". $content ."</td></tr>";
						}
						?>
					</table>
				</center>
			</div>
		</body>
		<?php
	}

	function subPluginWebsite() {

		?>
		<body>
			<center>
				<h1>SubPlugin Page</h1>
			</center>
		</body>
		<?php
	}

}

$testPlugin = new TestPLugin();

?>