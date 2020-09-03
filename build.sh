

cd themes/sswebpack_engine_only/
npm run build --theme_dir=themes/ecommerce-demo-theme
cd -

# gzip mytheme for extra fast delivery
sudo rm themes/ecommerce-demo-theme/dist*.gz -rf

# sudo rm themes/mytheme/dist/vendors~app.js -rf
gzip themes/ecommerce-demo-theme/dist/app.css        themes/ecommerce-demo-theme/dist/app.css.gz
gzip themes/ecommerce-demo-theme/dist/app.js         themes/ecommerce-demo-theme/dist/app.js.gz
gzip themes/ecommerce-demo-theme/dist/vendors~app.js themes/ecommerce-demo-theme/dist/vendors~app.js.gz
