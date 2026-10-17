package com.minimarket;

import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.stereotype.Service;
import java.util.List;

@Service
public class ProductoService {

    @Autowired
    private ProductoRepository repo;

    public List<Producto> listarActivos() {
        return repo.findByEliminado(0);
    }

    public Producto guardar(Producto p) {
        p.setEliminado(0); // Nos aseguramos de que nazca activo
        return repo.save(p);
    }

    public Producto actualizar(Integer id, Producto datos) {
        Producto p = repo.findById(id)
            .orElseThrow(() -> new RuntimeException("Producto no encontrado"));
        p.setNombre(datos.getNombre());
        p.setProveedor(datos.getProveedor());
        p.setFechaVencimiento(datos.getFechaVencimiento());
        p.setPrecio(datos.getPrecio());
        p.setStock(datos.getStock());
        return repo.save(p);
    }

    public void eliminarLogico(Integer id) {
        Producto p = repo.findById(id)
            .orElseThrow(() -> new RuntimeException("Producto no encontrado"));
        p.setEliminado(1);   // <-- clave: solo cambia el flag
        repo.save(p);
    }
}