CREATE TABLE material (
    id_material INTEGER PRIMARY KEY,
    mat_nombre VARCHAR(255) NOT NULL,
    mat_stock INTEGER NOT NULL,
    mat_unidad VARCHAR(50) NOT NULL
);

CREATE TABLE modulo (
    id_modulo INTEGER PRIMARY KEY,
    mod_descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE role (
    id_role INTEGER PRIMARY KEY,
    rol_descripcion VARCHAR(255) NOT NULL
);

CREATE TABLE permiso (
    id_role INTEGER NOT NULL,
    id_modulo INTEGER NOT NULL,
    PRIMARY KEY (id_role, id_modulo),
    FOREIGN KEY (id_role) REFERENCES role (id_role),
    FOREIGN KEY (id_modulo) REFERENCES modulo (id_modulo)
);

CREATE TABLE empleado (
    id_empleado INTEGER PRIMARY KEY,
    id_role INTEGER NOT NULL,
    emp_nombre VARCHAR(255) NOT NULL,
    emp_cedula VARCHAR(20) NOT NULL,
    emp_usuario VARCHAR(100) NOT NULL,
    emp_clave VARCHAR(100) NOT NULL,
    emp_direccion VARCHAR(255) NOT NULL,
    emp_telefono VARCHAR(20) NOT NULL,
    FOREIGN KEY (id_role) REFERENCES role (id_role)
);

CREATE TABLE promocion (
    id_promocion INTEGER PRIMARY KEY,
    pro_descripcion VARCHAR(255) NOT NULL,
    pro_descuento DECIMAL(5,2) NOT NULL,
    pro_vigencia_inicial DATE NOT NULL,
    pro_vigencia_fin DATE NOT NULL
);

CREATE TABLE vehiculo (
    id_vehiculo INTEGER PRIMARY KEY,
    veh_nombre VARCHAR(255) NOT NULL,
    veh_marca VARCHAR(100) NOT NULL,
    veh_modelo VARCHAR(100) NOT NULL,
    veh_ano INTEGER NOT NULL,
    veh_color VARCHAR(50) NOT NULL,
    veh_patente VARCHAR(20) NOT NULL
);

CREATE TABLE servicio (
    id_servicio INTEGER PRIMARY KEY,
    ser_nombre VARCHAR(255) NOT NULL,
    ser_precio DECIMAL(10,2) NOT NULL,
    ser_duracion INTEGER NOT NULL -- duración en minutos
);

CREATE TABLE uso (
    id_uso INTEGER PRIMARY KEY,
    id_material INTEGER NOT NULL,
    id_servicio INTEGER NOT NULL,
    FOREIGN KEY (id_material) REFERENCES material (id_material),
    FOREIGN KEY (id_servicio) REFERENCES servicio (id_servicio)
);

CREATE TABLE cliente (
    id_cliente INTEGER PRIMARY KEY,
    cli_nombre VARCHAR(255) NOT NULL,
    cli_direccion VARCHAR(255) NOT NULL,
    cli_telefono VARCHAR(20) NOT NULL,
    cli_usuario VARCHAR(100) NOT NULL,
    cli_clave VARCHAR(100) NOT NULL
);

CREATE TABLE turno (
    id_turno INTEGER PRIMARY KEY,
    id_cliente INTEGER NOT NULL,
    id_empleado INTEGER NOT NULL,
    id_vehiculo INTEGER NOT NULL,
    tur_fecha TIMESTAMP NOT NULL,
    tur_total DECIMAL(10,2) NOT NULL,
    FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_empleado) REFERENCES empleado (id_empleado),
    FOREIGN KEY (id_vehiculo) REFERENCES vehiculo (id_vehiculo)
);

CREATE TABLE opiniones (
    id_opiniones INTEGER PRIMARY KEY,
    id_cliente INTEGER NOT NULL,
    id_turno INTEGER NOT NULL,
    opi_nota TEXT NOT NULL,
    opi_calificacion INTEGER NOT NULL CHECK (opi_calificacion BETWEEN 1 AND 5),
    FOREIGN KEY (id_cliente) REFERENCES cliente (id_cliente),
    FOREIGN KEY (id_turno) REFERENCES turno (id_turno)
);

CREATE TABLE turno_detalle (
    id_turnodetalle INTEGER PRIMARY KEY,
    id_turno INTEGER NOT NULL,
    id_servicio INTEGER NOT NULL,
    id_promocion INTEGER NOT NULL,
    FOREIGN KEY (id_turno) REFERENCES turno (id_turno),
    FOREIGN KEY (id_servicio) REFERENCES servicio (id_servicio),
    FOREIGN KEY (id_promocion) REFERENCES promocion (id_promocion)
);
