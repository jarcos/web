# ProteCMS

ProteCMS es gestor para protectoras de animales. Un proyecto que ofrece la posibilidad de tener una página web totalmente gratuita a las protectoras de animales. Cada protectora tendrá total libertad y podrán gestionar su protectora a través de un completo panel de administración.

- [ProteCMS](#protecms)
    - [Instrucciones de instalación](#instrucciones-de-instalacion)
        - [Requisitos](#requisitos)
        - [Instalación](#instalacion)
            - [Homestead](#homestead)
            - [Instalando ProteCMS](#instalando-protecms)
    - [Colaboradores](#colaboradores)
    - [Errores](#errores)

## Instrucciones de instalación

### Requisitos

- [Homestead](https://laravel.com/docs/5.3/homestead)
- [NodeJS(npm)](https://nodejs.org/)
- [Composer](https://getcomposer.org/)
- [Yarn](https://yarnpkg.com/en/)

### Instalación

#### Homestead

Descarga e instala Homestead desde el [sitio oficial](https://laravel.com/docs/5.3/homestead), sigue las instrucciones de instalación. Ten en cuenta que necesitarás [Vagrant](https://vagrantup.com) y [VirtualBox](https://www.virtualbox.org) para poder utilizar Homestead.

Añade ProteCMS a tu archivo Homestead.yaml usando la siguiente configuración:

```bash
folders:
    - map: ~/Code/protecms
      to: /home/vagrant/code

sites:
    - map: protecms.local
      to: /home/vagrant/code/public
```

Añade la siguiente línea a tu archivo hosts:

```bash
192.168.10.10  protecms.local
```

#### Instalando ProteCMS

Descarga ProteCMS a tu carpeta `~/Code` usando el siguiente comando:

```bash
git clone git@github.com:protecms/web.git ~/protecms
```

Duplica el archivo _.env.example_ y renómbralo como _.env_. Cambia la línea 5 por:

```bash
APP_URL=http://protecms.local
```

Sitúate en la carpeta `~/Code/protecms` y ejecuta los siguientes comandos:

```bash
composer install
yarn dev
```


Arranca Homestead situándote en la carpeta de instalación y escribiendo el comando:

`vagrant up`

Visita [http://protecms.local](http://protecms.local)

## Colaboradores

- [Jaime Sares](http://jaimesares.com)
- [Ver más...](https://github.com/protecms/cms/graphs/contributors)

## Errores

Si detecta cualquier error, por pequeño que sea, no dudes en ponerte en contacto a web@protecms.com ofreciendo todos los detalles posibles (navegador, versión, sistema operativo, pasos para producirlo, etc). Asegúrate antes de que no está en la columna de Errores en el gestor del proyecto.