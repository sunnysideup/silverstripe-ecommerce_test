rm themes/ecommerce-demo-theme/dist/*.gz -rf

cd themes/sswebpack_engine_only/

npm run watch --theme_dir=themes/ecommerce-demo-theme
