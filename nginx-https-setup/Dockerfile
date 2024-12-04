FROM nginx:alpine

# Install OpenSSL for SSL certificates
RUN apk add --no-cache openssl

# Create a directory for SSL certificates
RUN mkdir -p /etc/nginx/ssl

# Generate a self-signed SSL certificate
RUN openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout /etc/nginx/ssl/server.key \
  -out /etc/nginx/ssl/server.crt \
  -subj "/C=MA/ST=Khouribga/L=Khouribga/O=1337/CN=hachahbo.42.fr"

# Copy the Nginx configuration file
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose ports for HTTP and HTTPS
EXPOSE 8081 8443

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
