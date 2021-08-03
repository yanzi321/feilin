# config valid for current version and patch releases of Capistrano
lock "~> 3.10.1"

set :application, "avenue"
set :repo_url, "git@gitee.com:rovast/avenue.git"

# Default branch is :master
# ask :branch, `git rev-parse --abbrev-ref HEAD`.chomp

# Default deploy_to directory is /var/www/my_app_name
# set :deploy_to, "/var/www/my_app_name"

# Default value for :format is :airbrussh.
# set :format, :airbrussh

# You can configure the Airbrussh format using :format_options.
# These are the defaults.
# set :format_options, command_output: true, log_file: "log/capistrano.log", color: :auto, truncate: :auto

# Default value for :pty is false
# set :pty, true

# Default value for :linked_files is []
append :linked_files, ".env"

# Default value for linked_dirs is []
append :linked_dirs, "storage"

# Default value for default_env is {}
# set :default_env, { path: "/opt/ruby/bin:$PATH" }

# Default value for local_user is ENV['USER']
# set :local_user, -> { `git config user.name`.chomp }

# Default value for keep_releases is 5
set :keep_releases, 20

# Uncomment the following to require manually verifying the host key before first deploy.
# set :ssh_options, verify_host_key: :secure


# 部署的几个钩子流程如下
# deploy:starting    - start a deployment, make sure everything is ready
# deploy:started     - started hook (for custom tasks)
# deploy:updating    - update server(s) with a new release
# deploy:updated     - updated hook
# deploy:publishing  - publish the new release
# deploy:published   - published hook
# deploy:finishing   - finish the deployment, clean up everything
# deploy:finished    - finished hook
namespace :deploy do
  desc "update composer package"
  after :updated, :build do
    on roles(:web) do
        within release_path do
            execute :php, "composer.phar install"
            execute :php, "artisan storage:link"
            execute :php, "artisan config:cache"
            execute :php, "artisan route:cache"
            execute :php, "composer.phar dump-autoload  -o"
            execute :sudo, "/bin/chmod -R 777 bootstrap/cache/ storage"
        end
    end
  end

  after :finished, :cleanup do
    on roles(:web) do
      execute :sudo, "/etc/init.d/php7.2-fpm reload"
      execute :sudo, "supervisorctl reload all"
      execute :sudo, "supervisorctl restart all"
    end
  end
end
