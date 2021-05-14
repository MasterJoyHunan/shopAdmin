#!/bin/sh
echo "开始制作镜像..."
image_tag=`date +%Y_%m_%d_%H_%M`
echo "当前时间：$image_tag"

# 修改这里 - 软件名
soft_name="shop-template"

# 仓库
store="tanwuyang"

# 远程仓库地址
registry_url="registry.cn-hangzhou.aliyuncs.com"

docker build -t ${registry_url}/${store}/${soft_name}:v${image_tag} .
# 回收中间层镜像
docker system prune -f
echo "制作镜像成功!"

echo "镜像最新版本提交"
docker push ${registry_url}/${store}/${soft_name}:v${image_tag}
echo "镜像最新版本提交 完成"