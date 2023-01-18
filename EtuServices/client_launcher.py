import redis
import sys


r = redis.Redis('localhost', 6379, charset="utf-8", decode_responses=True)

utilisateur = sys.argv[1]
#utilisateur = "gueriot.benjamin@gmail.com"

def setSession(utilisateur):
    r.set(f"{utilisateur}:count", 1)
    r.set(f"{utilisateur}:time", 1)
    r.expire(f"{utilisateur}:time", 600)
    r.expire(f"{utilisateur}:count", 600)
    r.set(utilisateur, 1)

def incrSession(utilisateur):
    r.incr(f"{utilisateur}:count")

def getSession(utilisateur):
    return {"timeout": r.get(f"{utilisateur}:time"), "count": r.get(f"{utilisateur}:count")}





userSession = getSession(utilisateur)
sessionTimeout = userSession["timeout"]
sessionCount = userSession["count"]

if sessionTimeout == None:
    setSession(utilisateur)
    print("Nombre de connexions restantes : 9")
else:
    if int(sessionCount) < 10:
        incrSession(utilisateur)
        print(f"Nombre de connexions avant bloquage : {10 - (int(sessionCount) + 1)}")
    else:
        print(
            f"Trop de connexion, réessayez dans {r.ttl(utilisateur+':time') // 60} minutes.")

sys.exit()