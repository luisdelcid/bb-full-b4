<?php

class BB_Full_B4 {

	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	/**
	 * @return void
	 */
	static public function bb_full_b4(){
        $current_theme = wp_get_theme();
        if($current_theme->get('Template') !== 'bb-theme' && $current_theme->get('Name') !== 'Beaver Builder Theme'){
            return;
        }
        if(get_theme_mod('fl-framework', 'none') !== 'bootstrap-4'){
            return;
        }
        add_action('wp_enqueue_scripts', [__CLASS__, '_wp_enqueue_scripts_before'], 998); // Runs before FLTheme::enqueue_scripts.
        add_action('wp_enqueue_scripts', [__CLASS__, '_wp_enqueue_scripts_after'], 1000); // Runs after FLTheme::enqueue_scripts.
        add_filter('fl_theme_compile_less_paths', [__CLASS__, '_fl_theme_compile_less_paths']);
        add_filter('fl_theme_framework_enqueue', [__CLASS__, '_fl_theme_framework_enqueue'], 11); // Runs after FLLayout::fl_theme_framework_enqueue.
    }
	
	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	/**
	 * @return string
	 */
	static protected function get_the_most_accurate_version(){
        $files = glob(BB_FULL_B4__PLUGIN_DIR . 'less/*.less');
        $versions = array_map([__CLASS__, 'get_version'], $files);
        usort($versions, 'version_compare');
        foreach($versions as $version){
            if(version_compare(FL_THEME_VERSION, $version, '>')){
                continue;
            }
            break;
        }
        return $version;
    }

	/**
	 * @return string
	 */
	static protected function get_version($file = ''){
        return str_replace('theme-', '', wp_basename($file, '.less'));
    }

	// ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

	/**
	 * @return array
	 */
	static public function _fl_theme_compile_less_paths($paths){
        $less = BB_FULL_B4__PLUGIN_DIR . 'less/';
        $file = $less . 'theme-' . FL_THEME_VERSION . '.less';
        if(!file_exists($file)){
            $file = $less . 'theme-' . self::get_the_most_accurate_version() . '.less';
        }
		foreach($paths as $index => $path){
			if(FL_THEME_DIR . '/less/theme.less' !== $path){
				continue;
			}
			$paths[$index] = $file;
			break;
		}
		return $paths;
	}

	/**
	 * @return void
	 */
	static public function _fl_theme_framework_enqueue($framework){
        return \FLBuilderModel::is_builder_active() ? str_replace('base', 'bootstrap', $framework) : $framework;
	}

	/**
	 * @return void
	 */
	static public function _wp_enqueue_scripts_after(){
		$file = BB_FULL_B4__PLUGIN_DIR . '/css/bb-full-b4.css';
		$url = str_replace(wp_normalize_path(ABSPATH), site_url('/'), wp_normalize_path($file));
        wp_enqueue_style('bb-full-b4', $url, ['bootstrap-4', 'fl-automator-skin'], BB_FULL_B4__VERSION);
	}

	/**
	 * @return void
	 */
	static public function _wp_enqueue_scripts_before(){
        wp_enqueue_script('popper', 'https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js', ['jquery'], '1.16.1', true);
	}

    // ~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~~

}
