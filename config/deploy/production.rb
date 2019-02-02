server '68.183.82.61', user: 'bloodbank', roles: %w{web app}
set :ssh_options, {
    keys: %w(/home/jay/.ssh/id_rsa),
    forward_agent: false,
    auth_methods: %w(publickey)
  }