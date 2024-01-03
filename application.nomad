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
DATABASE_URL="mysql2://{{- with secret "database/creds/egeya" -}}{{ .Data.username }}:{{ .Data.password }}{{- end -}}@db-02.it-premium.local/egeya"
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
