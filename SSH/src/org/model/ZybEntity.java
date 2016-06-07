package org.model;

import javax.persistence.*;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "zyb", schema = "stuSys")
public class ZybEntity {
    private int id;
    private String zym;
    private Integer rs;
    private String fdy;

    @Id
    @Column(name = "id", nullable = false)
    public int getId() {
        return id;
    }

    public void setId(int id) {
        this.id = id;
    }

    @Basic
    @Column(name = "zym", nullable = false, length = 12)
    public String getZym() {
        return zym;
    }

    public void setZym(String zym) {
        this.zym = zym;
    }

    @Basic
    @Column(name = "rs", nullable = true)
    public Integer getRs() {
        return rs;
    }

    public void setRs(Integer rs) {
        this.rs = rs;
    }

    @Basic
    @Column(name = "fdy", nullable = true, length = 8)
    public String getFdy() {
        return fdy;
    }

    public void setFdy(String fdy) {
        this.fdy = fdy;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        ZybEntity zybEntity = (ZybEntity) o;

        if (id != zybEntity.id) return false;
        if (zym != null ? !zym.equals(zybEntity.zym) : zybEntity.zym != null) return false;
        if (rs != null ? !rs.equals(zybEntity.rs) : zybEntity.rs != null) return false;
        if (fdy != null ? !fdy.equals(zybEntity.fdy) : zybEntity.fdy != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = id;
        result = 31 * result + (zym != null ? zym.hashCode() : 0);
        result = 31 * result + (rs != null ? rs.hashCode() : 0);
        result = 31 * result + (fdy != null ? fdy.hashCode() : 0);
        return result;
    }
}
