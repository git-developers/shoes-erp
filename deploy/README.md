Tianos - deploy
===============

Pasos a ejecutar


ingresar a la instancia
======================= 
ssh -p 22 ubuntu@18.219.213.43 -i /home/pollo/.ssh/aws_10.pem


deploy
======
ansible-playbook -i hosts -s -u ubuntu pb-deploy.yaml --key-file /home/pollo/.ssh/aws_10.pem