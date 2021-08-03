set :branch, "master"

server "47.102.101.82", user: "luohao", roles: %w{app web}

set :deploy_to, "/home/Apps/prod.api.steptousa.cn"
