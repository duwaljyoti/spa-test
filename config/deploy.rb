# ./config/deploy.rb

lock '3.11.0'
set :application, 'Laravel_Capistrano_Test'
set :repo_url, 'https://github.com/duwaljyoti/spa-test.git'
# Default branch is :master
set :branch, ENV["branch"] || "master"
# Default deploy_to directory is /var/www/laravel-capistrano
set :deploy_to, '/home/bloodbank/laravel-capistrano'
set :laravel_dotenv_file, '/var/www/secrets/.env'
# Default value for keep_releases is 5
set :keep_releases, 5
append :linked_dirs, 
    'storage/app',
    'storage/framework/cache',
    'storage/framework/sessions',
    'storage/framework/views',
    'storage/logs'
namespace :composer do
    desc "Running Composer Install"
    task :install do
        on roles(:composer) do
            within release_path do
                execute :composer, "install --no-dev --quiet --prefer-dist --optimize-autoloader"
            end
        end
    end
end
namespace :laravel do
    task :fix_permission do
        on roles(:laravel) do
            execute :chmod, "-R ug+rwx #{shared_path}/storage/ #{release_path}/bootstrap/cache/"
            execute :chgrp, "-R www-data #{shared_path}/storage/ #{release_path}/bootstrap/cache/"
        end
    end
    task :configure_dot_env do
    dotenv_file = fetch(:laravel_dotenv_file)
        on roles (:laravel) do
        execute :cp, "#{dotenv_file} #{release_path}/.env"
        end
    end
end
namespace :deploy do
    after :updated, "composer:install"
    after :updated, "laravel:fix_permission"
    after :updated, "laravel:configure_dot_env"
end