class DatosModel {
    final String id;
    final String nombre;
    final String comentarios;

    DatosModel({
        required this.id,
        required this.nombre,
        required this.comentarios,
    });

    DatosModel copyWith({
        String? id,
        String? nombre,
        String? comentarios,
    }) => 
        DatosModel(
            id: id ?? this.id,
            nombre: nombre ?? this.nombre,
            comentarios: comentarios ?? this.comentarios,
        );

    factory DatosModel.fromJson(dynamic json) => DatosModel(
        id: json["id"],
        nombre: json["Nombre"],
        comentarios: json["Comentarios"],
    );

    Map<String, dynamic> toJson() => {
        "id": id,
        "Nombre": nombre,
        "Comentarios": comentarios,
    };
}
