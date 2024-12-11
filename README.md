Proyecto de una clinica, donde tenemos dos tipos de usuarios que accederan a la web, un paciente y un secretario, 
el secretario podra pedirles cita a los pacientes, tambien podra borar, editar y añadir medicos y pacientes.
El usuario solo podra pedir cita.

PRINCIPALES PUNTOS: 

Con un mismo login compruebo si las credenciales son de una paciente o un secretario, inicamos distintas secciones segun sean, y en el header detectaremos si somos usuarios o pacientes con un if,
donde metermos lo que deseamos que vean los secretarios y pacientes.

Ademas cuando un paciente pida cita se le enviara un correo con los datos de la cita, al igual que cuando el secretario le realize la cita al paciente le llegaran los datos con el correo del paciente
