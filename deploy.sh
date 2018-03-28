#!/bin/bash
PLUGIN=$"tableau-shortcode";
WP_PLUGIN_DIR=$"../../sites/wordpress/wp-content/plugins";
WP_PATH=$"../../sites/wordpress";

# Update PHP_VERSION for wp-cli
PHP_VERSION=$(ls /Applications/MAMP/bin/php/ | sort -n | tail -1);
export PATH="/Applications/MAMP/bin/php/${PHP_VERSION}/bin:$PATH";

wp plugin is-installed "$PLUGIN" --path="$WP_PATH"
if [[ $? ]]; then
    wp plugin uninstall "$PLUGIN" --deactivate --path="$WP_PATH" || exit 1;
fi

echo;
echo "Zipping plugin...";
zip -r "$PLUGIN.zip" "./$PLUGIN/"* || exit 1;

echo;
wp plugin install "./$PLUGIN.zip" --activate --path="$WP_PATH" || exit 1;

exit 0;