import stat
import time
import os
import commands
import subprocess
import calendar
from datetime import datetime, timedelta
import simplejson as json
import tg
import urlparse
import datetime
import os
from multiprocessing import Process,Queue,Array,RLock
class NodeService():

    def fbuffer(self,f, chunk_size=10000):
        while True:
            chunk = f.read(chunk_size)
            if not chunk: break
            yield chunk
    def upload_iso(self,auth,file):
        try:
            if file.filename:
                filen = os.path.basename(file.filename)
                #f = open(os.path.join(dir_path, fname), 'wb', 10000)
                #open('/home/esage/' + filen, 'wb').write(file.file.read())
                dir_path = r'/home/tgniu'
                f = open(os.path.join(dir_path, filen), 'wb', 10000)
                # Read the file in chunks
                for chunk in self.fbuffer(file.file):
                    f.write(chunk)
                    f.flush() 
                f.close()
                #main_iso(filen)
                message = 'The file "' + filen + '" was uploaded to '+dir_path+'successfully'
                return {'success':True,'message':message}
            else:
                message = 'No file was uploaded'
                return {'success':False,'message':message}

        except Exception,ex:
            return  {'success':False,'message':ex}
  