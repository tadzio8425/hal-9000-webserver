import requests, socket

def get_ip():
    s = socket.socket(socket.AF_INET, socket.SOCK_DGRAM)
    try:
        # doesn't even have to be reachable
        s.connect(('10.255.255.255', 1))
        IP = s.getsockname()[0]
    except Exception:
        IP = '127.0.0.1'
    finally:
        s.close()
    return IP


username = "USERNAME"
password = "PASSWORD"
hostname = "HOSTNAME" # your domain name hosted in no-ip.com

# Gets the current public IP of the host machine.
myip = get_ip()

# Gets the existing dns ip pointing to the hostname.
old_ip = socket.gethostbyname(hostname)

# Noip API - dynamic DNS update.
# https://www.noip.com/integrate/request.
def update_dns(config):
    r = requests.get("http://{}:{}@dynupdate.no-ip.com/nic/update?hostname={}&myip={}".format(*config))

    if r.status_code != requests.codes.ok:
        print(r.content)
    pass

# Update only when ip is different.
if myip != old_ip:
    update_dns( (username, password, hostname, myip) )
pass