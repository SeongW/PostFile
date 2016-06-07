package org.model;

import javax.persistence.*;

/**
 * Created by wujiacheng on 16/6/6.
 */
@Entity
@Table(name = "kcb", schema = "stuSys")
public class KcbEntity {
    private String kch;
    private String kcm;
    private String kxxq;
    private Integer xs;
    private Integer xf;

    @Id
    @Column(name = "kch", nullable = false, length = 3)
    public String getKch() {
        return kch;
    }

    public void setKch(String kch) {
        this.kch = kch;
    }

    @Basic
    @Column(name = "kcm", nullable = true, length = 12)
    public String getKcm() {
        return kcm;
    }

    public void setKcm(String kcm) {
        this.kcm = kcm;
    }

    @Basic
    @Column(name = "kxxq", nullable = true, length = 45)
    public String getKxxq() {
        return kxxq;
    }

    public void setKxxq(String kxxq) {
        this.kxxq = kxxq;
    }

    @Basic
    @Column(name = "xs", nullable = true)
    public Integer getXs() {
        return xs;
    }

    public void setXs(Integer xs) {
        this.xs = xs;
    }

    @Basic
    @Column(name = "xf", nullable = true)
    public Integer getXf() {
        return xf;
    }

    public void setXf(Integer xf) {
        this.xf = xf;
    }

    @Override
    public boolean equals(Object o) {
        if (this == o) return true;
        if (o == null || getClass() != o.getClass()) return false;

        KcbEntity kcbEntity = (KcbEntity) o;

        if (kch != null ? !kch.equals(kcbEntity.kch) : kcbEntity.kch != null) return false;
        if (kcm != null ? !kcm.equals(kcbEntity.kcm) : kcbEntity.kcm != null) return false;
        if (kxxq != null ? !kxxq.equals(kcbEntity.kxxq) : kcbEntity.kxxq != null) return false;
        if (xs != null ? !xs.equals(kcbEntity.xs) : kcbEntity.xs != null) return false;
        if (xf != null ? !xf.equals(kcbEntity.xf) : kcbEntity.xf != null) return false;

        return true;
    }

    @Override
    public int hashCode() {
        int result = kch != null ? kch.hashCode() : 0;
        result = 31 * result + (kcm != null ? kcm.hashCode() : 0);
        result = 31 * result + (kxxq != null ? kxxq.hashCode() : 0);
        result = 31 * result + (xs != null ? xs.hashCode() : 0);
        result = 31 * result + (xf != null ? xf.hashCode() : 0);
        return result;
    }
}
