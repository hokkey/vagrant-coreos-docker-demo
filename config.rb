# Size of the CoreOS cluster created by Vagrant
$num_instances=1

# Used to fetch a new discovery token for a cluster of size $num_instances
$new_discovery_url="https://discovery.etcd.io/new?size=#{$num_instances}"

# Change basename of the VM
# The default value is "core", which results in VMs named starting with
# "core-01" through to "core-${num_instances}".
$instance_name_prefix='core'

# Change the version of CoreOS to be installed
# To deploy a specific version, simply set $image_version accordingly.
# For example, to deploy version 709.0.0, set $image_version="709.0.0".
# The default value is "current", which points to the current version
# of the selected channel
$image_version = 'current'

# Official CoreOS channel from which updates should be downloaded
$update_channel='stable'

# Log the serial consoles of CoreOS VMs to log/
# Enable by setting value to true, disable with false
# WARNING: Serial logging is known to result in extremely high CPU usage with
# VirtualBox, so should only be used in debugging situations
#$enable_serial_logging=false

# Enable port forwarding of Docker TCP socket
# Set to the TCP port you want exposed on the *host* machine, default is 2375
# If 2375 is used, Vagrant will auto-increment (e.g. in the case of $num_instances > 1)
# You can then use the docker tool locally by setting the following env var:
#   export DOCKER_HOST='tcp://127.0.0.1:2375'
#$expose_docker_tcp=2375

# Enable NFS sharing of your home directory ($HOME) to CoreOS
# It will be mounted at the same path in the VM as on the host.
# Example: /Users/foobar -> /Users/foobar
#$share_home=false

# Customize VMs
$vm_gui = false
$vm_memory = 3072
$vm_cpus = 2

# Share additional folders to the CoreOS VMs
# For example,
# $shared_folders = {'/path/on/host' => '/path/on/guest', '/home/foo/app' => '/app'}
# or, to map host folders to guest folders of the same name,
# $shared_folders = Hash[*['/home/foo/app1', '/home/foo/app2'].map{|d| [d, d]}.flatten]
$shared_folders = {'.' => '/home/core/dockerfiles'}

# Enable port forwarding from guest(s) to host machine, syntax is: { 80 => 8080 }, auto correction is enabled by default.
#$forwarded_ports = {}

# 外部ストレージ
$attached_storages = [
  {:file => 'data.vdi', :size => 100*1024, :port => 1, :device => 0, :dev => 'sdb', :dest => '/mnt/data'},
  {:file => 'image.vdi', :size => 100*1024, :port => 1, :device => 1, :dev => 'sdc', :dest => '/var/lib/docker'}
]

# ストレージをフォーマットしてマウント
def format_storage(dev, dest)
  fdisk = <<-EOF
    (echo n; echo p; echo 1; echo ; echo ; echo w) | fdisk /dev/#{dev}
    mkfs -t ext4 /dev/#{dev}1
    mount -t ext4 /dev/#{dev}1 #{dest}
  EOF
  return fdisk
end

# public_network setting
$bridge = 'en0: Ethernet'
$mac_address = '020027408ff0'

# docker_composeをインストール
$initialize = <<-EOF
  curl -L https://github.com/docker/compose/releases/download/1.5.2/docker-compose-`uname -s`-`uname -m` > ~/docker-compose
  sudo mkdir /opt
  sudo mkdir /opt/bin
  sudo mv ~/docker-compose /opt/bin/docker-compose
  sudo chown root:root /opt/bin/docker-compose
  sudo chmod +x /opt/bin/docker-compose
  
  mkdir -p /mnt/data/resourcespace/filestore 2>/dev/null
  mkdir -p /mnt/data/resourcespace/homeanim 2>/dev/null
  mkdir -p /mnt/data/resourcespace/homeanim/gfx 2>/dev/null
  chmod 767 -R /mnt/data/resourcespace/*
EOF

# docker_composeを起動する
$docker_compose_up = <<-EOF
  cd /home/core/dockerfiles
  docker-compose up -d mysql
  sleep 10
  docker-compose up -d etherpad
  sleep 10
  docker-compose up -d
EOF