package com.minimarket;

import jakarta.validation.Valid;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.http.ResponseEntity;
import org.springframework.web.bind.annotation.*;
import java.util.List;

@RestController
@RequestMapping("/api/productos")
@CrossOrigin(origins = "*")
public class ProductoController {

    @Autowired
    private ProductoService service;

    // 1. Listar solo activos (eliminado = 0)
    @GetMapping
    public List<Producto> listar() {
        return service.listarActivos();
    }

    // 2. Crear
    @PostMapping
    public ResponseEntity<Producto> crear(@Valid @RequestBody Producto p) {
        p.setEliminado(0);
        return ResponseEntity.status(201).body(service.guardar(p));
    }

    // 3. Editar
    @PutMapping("/{id}")
    public ResponseEntity<Producto> editar(@PathVariable Integer id,
                                            @Valid @RequestBody Producto p) {
        return ResponseEntity.ok(service.actualizar(id, p));
    }

    // 4. Eliminación LÓGICA (UPDATE, no DELETE)
    @DeleteMapping("/{id}")
    public ResponseEntity<Void> eliminar(@PathVariable Integer id) {
        service.eliminarLogico(id);
        return ResponseEntity.noContent().build();
    }
}