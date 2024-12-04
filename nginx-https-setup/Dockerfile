# Use a base image with Nginx
FROM nginx:alpine

# Install OpenSSL to generate SSL certificates
RUN apk add --no-cache openssl

# Create a directory for SSL certificates
RUN mkdir -p /etc/nginx/ssl

# Generate a self-signed SSL certificate
RUN openssl req -x509 -nodes -days 365 \
  -newkey rsa:2048 \
  -keyout /etc/nginx/ssl/server.key \
  -out /etc/nginx/ssl/server.crt \
  -subj "/C=US/ST=State/L=City/O=Organization/CN=localhost"

# Copy custom Nginx configuration
COPY nginx.conf /etc/nginx/conf.d/default.conf

# Expose ports for HTTP (8081) and HTTPS (8443)
EXPOSE 8081 8443

# Start Nginx
CMD ["nginx", "-g", "daemon off;"]
