vagrant-coreos-docker-demo
=========
Vagrant and Docker profiles for small web application server, inclluding Redmine, ResourceSpace, Gitbucket, Etherpad, EtherCalc and manet.

このデモは、Vagrant・CoreOS・Dockerを使った小規模な自宅サーバ向けの環境構築ファイルです。イミュータブルなインフラ構築を手軽に試せる内容になっています。

Qiitaに書いた記事、[Vagrant・CoreOS・Dockerでインフラ素人が自宅サーバを立てた話 - Qiita](http://qiita.com/y_hokkey/items/3dd0d8f20f9daadbbf0b)
で紹介した自宅サーバの構成を元に簡略化した構成になっています。

![](https://cloud.githubusercontent.com/assets/6197292/13034152/0691d8e0-d371-11e5-9f1b-63a3827538ba.png)

## System Requirements

* Vagrant 1.7.4 or later with NFS support

## How to use

```
git clone git@github.com:hokkey/vagrant-coreos-docker-demo.git
cd vagrant-coreos-docker-demo
vagrant up
...
==> core-01: Pruning invalid NFS exports. Administrator privileges will be required...
Password: (enter admin password here)
```
When all set up was done, access to http://localhost:8888/.

if you want manage docker containers manually, see below.

```
cd vagrant-coreos-docker-demo
vagrant ssh
cd dockerfiles

docker-compose stop
docker-compose up -d
docker-compose logs
```
Your change of working copy imminently affects in VMs "/home/core/dockerfiles" directory.

## Installed Applications
* Redmine: ITS
* ResourceSpace: DAM
* Gitbucket: git server
* Etherpad: real-time wordpad
* EtherCalc: real-time spreadsheets
* manet: web screenshot server
* MySQL: RDB
* Redis: NoSQL

## Default Passwords

* ResourceSpace: admin/admin
* Redmine: admin/admin
* Gitbucket: root/root
* MySQL(root): please\_enter\_your\_password

## System Architecture

![](https://cloud.githubusercontent.com/assets/6197292/13034151/01c77590-d371-11e5-8086-c377b1eb6cdb.png)

永続的に保存するデータをdata.vdiに隔離し、それ以外はイミュータブルな構成としています。

### Vagrantfile

#### Network

This demo is configured as internal network. You can access the apps with localhost's port 8888(Web), 33060(MySQL) and 29418(gitbucket's SSH).

#### Data Storage

All persistant data will be saved in "data.vdi". You only have to backup this virtual disk image, and anytime you could destroy other files and rebuild VM.

When executing `vagrant up`, vagrant checks the storages are exist or not, and decide to create new one or just attach them to the VM. 

"image.vdi" is a cache of docker images.

#### CAUTION
DO NOT EXECUTE `vagrant destroy` WITHOUT DETACHING "data.vdi"!  
Vagrant will delete all external storage file when you destroy the VM, so you have to detach the storage with VirtualBox GUI.

#### 注意
`vagrant destroy`をする場合、かならずVirtualBoxの管理画面上で「data.vdi」の接続を仮想マシンから解除してください。vagrantは仮想マシンに紐付く外部ディスクもまとめて削除してしまうため、データが失われます。

===

### CoreOS

"cloud-config" is almost default but added mount settings to use the external disks.

===

### Docker

This demo uses docker-compose to manage docker containers.

#### Nginx

nginx is configured as a reverse proxy. It also run as a docker container.

## Author

y_hokkey http://media-massage.net/

## Credit

An original ResourceSpace Dockerfile is by michael-harris.

[michael-harris/resourcespace-docker: ResourceSpace Docker Container Built on phusion/baseimage](https://github.com/michael-harris/resourcespace-docker)

## License

Apache License 2.0