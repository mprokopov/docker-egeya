variable "env" {
  default = "production"
}

variable "version" {
  default = "${DRONE_COMMIT_SHA}"
}

job "egeya" {
  datacenters = ["*"]
  type = "service"

  vault {
    policies = ["egeya"]
  }

  group "egeya" {
    network {
      dns {
        servers = ["172.17.0.1", "8.8.8.8", "8.8.4.4"]
      }
      port "web" {
        to = 80
      }
    }

    service {
      name ="egeya"
      port     = "web"

      provider = "consul"

      tags = [
        "public.enable=true",
        "public.http.routers.egeya.rule=Host(`blog.it-premium.com.ua`)",
        "public.http.routers.egeya.tls=true",
        "public.http.routers.egeya.tls.certresolver=myresolver",

        "public.http.middlewares.egeya-redirect-web-secure.redirectscheme.scheme=https",

        "public.http.routers.egeya-http.rule=Host(`blog.it-premium.com.ua`)",
        "public.http.routers.egeya-http.middlewares=egeya-redirect-web-secure",

        "traefik.enable=true",
        "traefik.http.routers.blog.rule=Host(`blog.it-premium.internal`)",
      ]
    }

    task "web" {
      driver = "docker"
      config {
        image = "663084659937.dkr.ecr.eu-central-1.amazonaws.com/blog_it_premium:${var.version}"

        ports = ["web"]

        labels {
          application = "egeya"
          production_status = var.env
        }
      }
      env {
        RAILS_ENV = var.env
      }
      template {
        data = <<EOF
{
    "appearance": {
        "notes_per_page": 10,
        "respond_to_dark_mode": true,
        "show_view_counts": false,
        "show_sharing_buttons": false
    },
    "comments": {
        "default_on": false,
        "require_gip": false,
        "fresh_only": false
    },
    "template": "acute",
    "db": {
        "server": "{{ .Data.data.host }}",
        "user_name": "{{ .Data.data.username }}",
        "passw": "{{ .Data.data.password }}",
        "name": "{{ .Data.data.name }}"
    },
    "language": "en",
    "blog_title": "Discover Docker, K8s and Hashicorp Nomad with Maksym Prokopov",
    "author": "Maksym Prokopov",
    "author_email": "",
    "notifications": {
        "new_comments": false
    },
    "blog_subtitle": "The blog about containerisation, virtual machines and useful shell snippets and findings",
    "meta_description": "The blog about containerisation, virtual machines and useful shell snippets and findings",
    "timezone": {
        "offset": 3600,
        "is_dst": false
    }
}
EOF
  destination = "secrets/settings.json"
      }
      template {
        data = <<EOF
{{- with secret "instances/data/egeya/database" }}
DATABASE_URL=mysql2://{{ .Data.data.username }}:{{ .Data.data.password }}@{{ .Data.data.host }}/{{ .Data.data.name }}
MYSQL_HOST={{ .Data.data.host }}
MYSQL_USER={{ .Data.data.username }}
MYSQL_PASSWORD={{ .Data.data.password }}
MYSQL_DATABASE={{ .Data.data.name }}
EOF
        destination = "secrets/database.env"
        env = true
      }

      volume_mount {
        volume      = "themes"
        destination = "/var/www/html/themes"
      }

      volume_mount {
        volume      = "pictures"
        destination = "/var/www/html/pictures"
      }

      volume_mount {
        volume      = "user"
        destination = "/var/www/html/user"
      }
    }

    volume "themes" {
      type = "host"
      source = "themes"
    }

    volume "pictures" {
      type = "host"
      source = "pictures"
    }

    volume "user" {
      type = "host"
      source = "user"
    }
  }
}
