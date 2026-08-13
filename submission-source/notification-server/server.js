import 'dotenv/config';
import express from 'express';
import cors from 'cors';
import { createServer } from 'node:http';
import { Server } from 'socket.io';

const app=express();
const server=createServer(app);
const allowedOrigin=process.env.LARAVEL_URL??'http://127.0.0.1:8000';
const io=new Server(server,{cors:{origin:allowedOrigin,methods:['GET','POST']}});
app.use(cors({origin:allowedOrigin}));
app.use(express.json());

app.get('/health',(_request,response)=>response.json({status:'ok',connections:io.engine.clientsCount}));
app.post('/broadcast',(request,response)=>{
  if(request.get('X-Broadcast-Key')!==(process.env.BROADCAST_KEY??'presentation-demo-key')) return response.status(401).json({message:'Invalid broadcast key'});
  const {id,event,message,sent_at}=request.body;
  if(!message||typeof message!=='string') return response.status(422).json({message:'A message is required'});
  const announcement={id,event,message,sent_at:sent_at??new Date().toISOString()};
  io.emit('new-announcement',announcement);
  response.status(202).json({message:'Announcement broadcast',announcement});
});
io.on('connection',socket=>{ console.log(`Student connected: ${socket.id}`); socket.emit('connection-ready',{message:'Real-time connection established'}); socket.on('disconnect',()=>console.log(`Student disconnected: ${socket.id}`)); });
const port=Number(process.env.PORT??3000);
server.listen(port,()=>console.log(`Notification server running at http://localhost:${port}`));
